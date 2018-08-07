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

    public function multInsertUseORM()
    {
        $data = $this->generateData();

        $startTime = bcmul(microtime(true), 1000);
        DB::table('dating_tmp')->insert($data);

        $execTime = bcmul(microtime(true), 1000) - $startTime;

        return "orm exec time= {$execTime} ms";

    }

    public function multInsertUsePdo()
    {
        $result = $this->generateData();

        $chunks = array_chunk($result, 1000);

        $startTime = bcmul(microtime(true), 1000);
        $pdo = DB::connection()->getPdo();

        foreach ($chunks as &$data) {

            $fields = array_keys($data[0]);
            $fieldStr = implode(',', $fields);
            $sql = "INSERT INTO dating_tmp($fieldStr) VALUES ";

            $placeholders = [];
            foreach ($fields as $field) {
                $placeholders[] = '?';
            }
            $placeholders = implode(',', $placeholders);
            foreach ($data as &$item) {
                $sql .= "($placeholders),";
            }
            unset($item);
            $sql = substr($sql, 0, -1);
            $stmt = $pdo->prepare($sql);

            $i = 1;
            foreach ($data as &$item) {
                foreach ($item as $key => $val) {
                    $stmt->bindValue($i++, $val,\PDO::PARAM_STR);
                }
            }
            unset($item);
            $ret = $stmt->execute();
        }
        unset($data);

        $execTime = bcmul(microtime(true), 1000) - $startTime;

        return "pdo exec time= {$execTime} ms. ret=$ret";

    }

    public function multInsertUsePdoNoBind()
    {
        $data = $this->generateData();

        $startTime = bcmul(microtime(true), 1000);
        $pdo = DB::connection()->getPdo();

        $fields = array_keys($data[0]);
        $fieldStr = implode(',', $fields);
        $sql = "INSERT INTO dating_tmp($fieldStr) VALUES ";
        foreach ($data as &$item) {
            $values = array_values($item);
            $valStr = implode(',', $values);
            $sql .= "($valStr),";
        }
        unset($item);
        $sql = substr($sql, 0, -1);
        $ret = $pdo->exec($sql);

        $execTime = bcmul(microtime(true), 1000) - $startTime;

        return "pdo no bind exec time= {$execTime} ms. ret=$ret";

    }

    public function &generateData()
    {
        $data = [];

        for ($i = 0; $i < 10000; $i++) {
            $days = rand(1,1000);
            $data[] = [
                'name' => str_random(),
                'cardNo' => str_random(32),
                'descriot' => str_random(64),
                'ctftp' => str_random(10),
                'ctfid' => str_random(64),
                'gender' => rand(1,3),
                'birthday' => date('Y-m-d', strtotime("-$days day")),
                'version' => date('Y-m-d H:i:s', strtotime(strtotime("-$days day"))),
                'address' => str_random(128),
                'zip' => str_random(40),
                'dirty' => str_random(20),
                'district1' => str_random(64),
                'district2' => str_random(64),
                'district3' => str_random(64),
                'district4' => str_random(64),
                'district5' => str_random(64),
                'district6' => str_random(64),
                'firstnm' => str_random(10),
                'lastnm' => str_random(10),
                'duty' => str_random(32),
                'mobile' => str_random(11),
                'tel' => str_random(),
                'fax' => str_random(),
                'email' => str_random(30),
                'nation' => str_random(18),
                'taste' => str_random(32),
                'education' => str_random(4),
                'company' => str_random(128),
                'ctel' => str_random(),
                'caddress' => str_random(128),
                'czip' => str_random(),
                'family' => str_random(1)
            ];
        }
        return $data;
    }
}
