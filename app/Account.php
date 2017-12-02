<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'user_id';
    protected $incrmenting = false;

    /**
     * 返回该账号所属的用户
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
