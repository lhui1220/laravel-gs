<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Reflection;

class ReflectionControllerTest extends Controller
{
    /** 类名-实例的关联数组 */
    private $container;

    public function __construct()
    {
        $this->container = [];
    }

    public function testReflectionClass()
    {
        $className = ReflectionController::class;
        $methodName = 'show';
        $result = $this->call($className, $methodName);
        return response($result);
    }

    public function testReflectionProperty()
    {
        $className = ReflectionController::class;
        $class = new \ReflectionClass($className);
        $properties = $class->getProperties();

        $props = [];
        foreach ($properties as $property) {
            $props[] = [
                'name' => $property->getName(),
                'modifiers' => \Reflection::getModifierNames($property->getModifiers()),
                'value' => $property->isPublic() ? $property->getValue() : null,
            ];
        }
        return response()->json(['props' => $props]);

    }

    private function make($className)
    {
        if (isset($this->container[$className])) {
            return $this->container[$className];
        }
        $class = new \ReflectionClass($className);
        $constructor = $class->getConstructor();
        if ($constructor) {
            $params = $constructor->getParameters();
            $args = [];
            foreach ($params as $param) {
                if ($param->getClass()) {
                    $args[] = $this->make($param->getClass()->getName());
                } elseif ($param->isDefaultValueAvailable()) {
                    $args[] = $param->getDefaultValue();
                } else {
                    $args[] = null;
                }
            }
            $instance = $class->newInstanceArgs($args);
        } else {
            $instance = $class->newInstance();
        }

        $this->container[$className] = $instance;
        return $instance;
    }

    private function call($className, $methodName)
    {

        //实例化
        $instance = $this->make($className);

        $class = new \ReflectionClass($className);
        if (!$class->hasMethod($methodName)) {
            throw new \Exception('Method not found.');
        }
        $method = $class->getMethod($methodName);
        //形参列表
        $params = $method->getParameters();

        $args = []; //实参列表
        foreach ($params as $param) {
            if ($param->getClass()) {
                //通过类型提示依赖注入
                $args[] = $this->make($param->getClass()->getName());
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                $args[] = null;
            }
        }
        //调用方法
        return $method->invokeArgs($instance, $args);
    }
}
