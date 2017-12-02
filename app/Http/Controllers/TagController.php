<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create(Request $req) {
        $json = $req->getContent();
        $obj = json_decode($json,true);
        $tag = new Tag();
        $tag->name = $obj['name'];
        $tag->save();
        return response()->json($tag);
    }

    /**
     * 获取打了指定标签的文章列表
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function articles($id) {
        $tag = Tag::findOrFail($id);
        $articles = $tag->articles;
        return response()->json($articles);
    }
}
