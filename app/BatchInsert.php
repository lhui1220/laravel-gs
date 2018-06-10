<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2018/6/4
 * Time: 22:21
 */

namespace App;


trait BatchInsert
{

    public function batchInsert($model,$data, $batchSize = 15)
    {
        $model::insert($data);
    }
}