<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response()->json($arr)->withHeaders(['X-token' => 'token-xxx']);
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
        SendMail::dispatch(['from' => 'liuhui','to' => 'yunyun','subject' => 'For love','content' => 'I love you!'])
            ->onConnection('rabbit')
            ->onQueue('emails');
        return response()->json($result);
    }

    /**
     * 参考http://laravelacademy.org/post/8060.html
     */
    public function dblock() {
        /*
         * 悲观锁(在查询数据的时候加锁,别的事务更新数据时会阻塞直到获取到锁)
         * 实现方式有两种:
         * <ul>
         *  <li>select ... lock in share mode</li>
         *  <li>select ... for update</li>
         * </ul>
         * 总结:for update 与 lock in share mode 都是用于确保被选中的记录值不能被其它事务更新（上锁），两者的区别在于 lock in share mode 不会阻塞其它事务读取被锁定行记录的值，而 for update 会阻塞其他锁定性读对锁定行的读取（非锁定性读仍然可以读取这些记录，lock in share mode 和 for update 都是锁定性读）。
         */
        DB::table('users')->where('id',1)->sharedLock()->first(); //select ... lock in share mode

        DB::table('users')->where('id',2)->lockForUpdate()->first(); //select ... for update

        //乐观锁(在查询数据的时候不加锁，在更新数据的时候会检测版本号)
    }
}
