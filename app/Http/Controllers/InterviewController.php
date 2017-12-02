<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * 二维数组的值首字母转大写(主要考察引用传递和值传递)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ucfirst() {
        $arr = [
            ['k1'=>'v1','k2'=>'v2'],
            ['k1'=>'v1','k2'=>'v2']
        ];
        foreach ($arr as &$inner_arr) {
            foreach ($inner_arr as $key => $val) {
                $inner_arr[$key] = ucfirst($val);
            }
        }
        unset($inner_arr);
        return response()->json($arr);
    }

    /**
     * 正则提取a标签的href属性值与其文本内容,并保存到关联数组
     */
    public function regex() {
        //====匹配html====
        $html = '<a href="www.baidu.com">百度</a>';
//        $html .= '<a href="www.ali.com">阿里</a>';
//        $html .= '<a href="www.tencent.com">腾讯</a>';
        //====匹配html====

//        $pattern = '/<a href="\w+">.+?<\/a>/';
//        $pattern = '/.+/';//all
        //====匹配电话号码====
//        $html = '010-12345678';
//        $html = '0101-1234567';
//        $pattern = '/^0\d{2}-\d{8}$|^0\d{3}-\d{7}$/'; //分支
        //====匹配电话号码====

        $pattern = '/^(\d{1,3}\.){3}\d{1,3}$/'; //匹配ip
        $html = '127.11.22.1';
        $result = array();
        if (preg_match($pattern, $html, $matches)) {
//            $result[$matches[1]] = $matches[2];
            print_r($matches);
        }
        return response()->json($result);
    }
}
