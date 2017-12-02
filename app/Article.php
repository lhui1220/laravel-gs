<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function publisher() {
        //这里必须得指定外键字段,否则会默认为'publisher_id'
        return $this->belongsTo('App\User','user_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag','article_tag','article_id','tag_id');
    }
}
