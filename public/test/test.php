<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2018/3/6
 * Time: 11:46
 */

require_once "./Singleton.php";

$a = Singleton::getInstance();
$b = Singleton::getInstance();

$c = clone $a;

$a->field = "aaaa";

echo "a=$a->field, b=$b->field,c=$c->field";
