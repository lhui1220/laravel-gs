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

        $html = '<a href="www.baidu.com">百度</a>';
        $html .= '<a href="www.ali.com">阿里</a>';
        $html .= '<a href="www.tencent.com">腾讯</a>';

        $pattern = '/<a href="(.+)">(.+)<\/a>/U';
        $result = [];
        if (preg_match_all($pattern, $html, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $result[$match[1]] = $match[2];
            }
        }
        return response()->json($result);
    }
}
