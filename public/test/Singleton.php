<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2018/3/6
 * Time: 11:41
 */
class Singleton
{
    private static $instance;

    public $field = "a";

    private function __construct()
    {
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
        echo "clone called.<br>";
    }

}