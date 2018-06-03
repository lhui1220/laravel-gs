<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StaticController extends Controller
{
    //
    public function goods($id)
    {
        $key = "goods_$id";
        $val = Cache::get($key);
        if ($val) {
            return $val;
        }
        $resp = response()->view('goods',['id'=>$id ,'time'=>time()]);
        Cache::put($key,$resp->getContent(),3);
        return $resp;
    }
}
