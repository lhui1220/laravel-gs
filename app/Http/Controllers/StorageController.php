<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{

    public function saveFile() {
        //保存文件
        $default_path = Storage::put('default_file.txt','Hello,World!'); //use default disk
        $local_path = Storage::disk('local')->put('local_file.txt','Hello,World!'); //use local disk
        $public_path = Storage::disk('public')->put('public_file.txt','Hello,World!'); //use public disk
        $oss_path = Storage::disk('ali-oss')->put('oss_file.txt','Hello,World!'); //use ali-oss disk
        return response()->json(['default'=>$default_path,
            'local'=>$local_path,
            'public'=>$public_path,
            'oss'=>$oss_path]);
    }

    public function getFile() {
        //获取文件内容
        $default_content = Storage::get('default_file.txt'); //use default disk
        $local_content = Storage::disk('local')->get('local_file.txt'); //use local disk
        $public_content = Storage::disk('public')->get('public_file.txt'); //use public disk
        $oss_content = Storage::disk('ali-oss')->get('oss_file.txt'); //use ali-oss disk

        return response()->json(['default'=>$default_content,
            'local'=>$local_content,
            'public'=>$public_content,
            'oss'=>$oss_content]);
    }

    public function delFile() {
        $res = Storage::disk('ali-oss')->delete('oss_file.txt');
        return response()->json(['ret'=>$res]);
    }

    public function mkdir() {
        //创建目录和文件
        $ret = Storage::makeDirectory('a/b/c');
        Storage::put('a/a1.txt','a1111111');
        Storage::put('a/b/b1.txt','b11111');
        Storage::put('a/b/b2.txt','b22222');

        return response()->json(['result'=>$ret]);
    }

    public function delDir() {
        $dir = 'a/';
        $ret = Storage::deleteDir($dir);
        return response()->json(['result'=>$ret]);
    }

    public function getFiles() {
        //遍历指定目录下的文件
        $directory = 'a/';
        $files = Storage::files($directory);
        return response()->json($files);
    }

    public function getAllFiles() {
        //递归遍历指定目录下的文件
        $directory = 'a/';
        $files = Storage::allFiles($directory);
        return response()->json($files);
    }
}
