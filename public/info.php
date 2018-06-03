<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/11/25
 * Time: 21:19
 */

//echo phpinfo();

//$result = array_merge(['a','b'],[]);
//d($result);
//
//$result = array_merge(['a','b'],['c']);
//d($result);
//
//$result = array_merge(['a','b'],'c');
//d($result);

//require "includ.php";
//require_once "includ.php";

include "include.php";
include "include.php";
//include_once "includ.php";

function mkdirs($path) {
    if (is_dir($path)) {
        echo "dir exists";
    } else {
        $res = mkdir($path,0777,true);
        if ($res) {
            echo "mkdir success";
        }else {
            echo "mkdir fail";
        }
    }
}
mkdirs("foo/bar/baz");

function concurr_write($filename,$content)
{
    $fp = fopen($filename,'w');
    if (flock($fp,LOCK_EX)) {
        fwrite($fp,$content);
        flock($fp,LOCK_UN);
    };
    fclose($fp);
}

concurr_write("foo/data.txt","1234");

function get_ext1($url)
{
    $parts = parse_url($url);
    $path = $parts['path'];
    $last_idx = strrpos($path, ".");
    return substr($path, $last_idx+1);
}

function get_ext2($url)
{
    $parts = parse_url($url);
    $path = $parts['path'];
    return substr(strrchr($path, "."),1);
}

function get_ext3($url)
{
    $parts = parse_url($url);
    $path = $parts['path'];
    $arr = explode('.',$path);
    return array_pop($arr);
}

function get_ext4($url)
{
    $parts = parse_url($url);
    $path = $parts['path'];
    $info = pathinfo($path);
    return $info['extension'];
}

function get_ext5($url)
{
    $parts = parse_url($url);
    $path = $parts['path'];
    return pathinfo($path,PATHINFO_EXTENSION);
}

echo "<br>";
$ext1 = get_ext1("http://www.sina.com.cn/abc/de/fg.php?id=1");
$ext2 = get_ext2("http://www.sina.com.cn/abc/de/fg.php?id=1");
$ext3 = get_ext3("http://www.sina.com.cn/abc/de/fg.php?id=1");
$ext4 = get_ext4("http://www.sina.com.cn/abc/de/fg.php?id=1");
$ext5 = get_ext5("http://www.sina.com.cn/abc/de/fg.php?id=1");
print_r("$ext1-$ext2-$ext3-$ext4-$ext5");

function is_email($email)
{
    return preg_match('/^[\w\-\.]+@[\w\-]+(\.\w+)+$/',$email);
}

echo "<br>";
echo is_email("123@163.com.cn") ? 'true' : 'false';

function match() {
    $res = preg_match('/.*xyz\d/','*****xyz1');
    echo $res? '<br>true' : '<br>false';
}

match();

function list_dir($dir)
{
    $result = [];
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '..' || $file == '.') continue;

        if (is_dir($dir.'/'.$file)) {
            $result[] = $dir.'/'.$file;
            $result = array_merge($result,list_dir($dir.'/'.$file));
        } else {
            $result[] = $file;
        }
    }
    return $result;
}

$dir = './foo';
$dirs = list_dir($dir);
echo "<br>list dir<br>";
foreach ($dirs as $dir) {
    echo $dir, PHP_EOL;
}

$a = "aa\\\n\'aaaa";
$b = 'bb\\\n\'bb';
echo "<br>$a<br>";
echo "$b";

function d($result) {
    var_dump($result);
    echo '<br/>';
}