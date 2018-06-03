<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2018/5/12
 * Time: 21:37
 */

namespace App\Http\Controllers;


use App\Exceptions\ServiceException;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CorsController extends Controller
{

    public function simple()
    {
        return Tag::findTags(['simple','ok']);
    }

    public function preflighted(Request $request)
    {
        $raw = $request->getContent();
        Log::info(self::class . '::' . __FUNCTION__,['args'=>$raw]);
        $case = new \InvalidArgumentException("invalid arg",400);
        throw new ServiceException("service error",500,$case,['args'=>'a']);
        return json_decode($raw,true);
    }

    /**
     * 处理业务逻辑
     *
     * @param array args
     * @return void
     *
     * @author liuhui
     * @date 2018-05-25
     */
    public function doAddService(array $args)
    {
        $result = $args['a'] + $args['b'];
        $service = self::class . '::' . __FUNCTION__;
        //记录业务日志
        Log::info($service,['args'=>$args,'result'=>$result]);

    }

}