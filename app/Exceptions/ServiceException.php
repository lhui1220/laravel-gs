<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/12/1
 * Time: 21:12
 */

namespace App\Exceptions;

use Exception;

/**
 * 业务逻辑层异常
 *
 * @author liuhui
 * @date 2018-05-27
 *
 * @package App\Exceptions
 */
class ServiceException extends \Exception
{
    /**
     * @var array 上下文信息
     */
    protected $context;

    /**
     * 构造异常对象.
     * @param string $message 错误信息
     * @param int $code 错误码
     * @param Exception|null $previous
     * @param array $context
     */
    public function __construct($message = "", $code = 0, Exception $previous = null, $context = [])
    {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
    }

    /**
     * 获取该异常的上下文信息
     * @return array
     *
     * @author liuhui
     * @date 2018-05-27
     */
    public function getContext()
    {
        return $this->context;
    }

}