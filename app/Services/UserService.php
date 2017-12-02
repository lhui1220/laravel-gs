<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/12/1
 * Time: 20:03
 */

namespace App\Services;


use App\Account;
use App\Exceptions\ServiceException;
use App\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function create(User $user) {
        $result = false;
        try {
            DB::beginTransaction();

            $user->save();
            $account = new Account();
            $account->user_id = $user->id;
            $result = $account->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new ServiceException($e->getMessage(),$e->getCode(),$e);
        }
        return $result;
    }

    public function getUser($id) {
        $user =  User::find($id);
        $user->account = $user->account;
//        $user = DB::table('users')
//            ->join('accounts','users.id','=','accounts.user_id')
//            ->where('users.id',$id)
//            ->first();

        return $user;
    }

    public function getAccount($id) {
        $account = Account::find($id);
        $account->user = $account->user;
        return $account;
    }

}