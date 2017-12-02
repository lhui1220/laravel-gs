<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function create(Request $req) {
        $json = $req->getContent();
        $obj = json_decode($json,true);
        $art = new Article();
        $art->title = $obj['title'];
        $art->content = $obj['content'];
        $art->user_id = $obj['user_id'];
        $art->saveOrFail();
        return response()->json($art);
    }

    //
    public function info($id) {
        $article = Article::findOrFail($id);
        $article->publisher;
        return response()->json($article);
    }

    public function articles($user_id) {
        $user = User::findOrFail($user_id);
        $articles = $user->publishedArticles;
        return response()->json($articles);
    }

    public function addTag($artcle_id,$tag_id) {
        $data = ['article_id'=>$artcle_id,'tag_id'=>$tag_id];
        DB::table('article_tag')->insert($data);
        return response()->json($data);
    }

    /**
     * 获取指定文章的标签列表
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function tags($id) {
        $art = Article::findOrFail($id);
        $tags = $art->tags;
        return response()->json($tags);
    }
}
