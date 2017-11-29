<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2017/11/29
 * Time: 21:09
 */

namespace App\Services;

class HeroService
{
    public function getHeroes() {
//        return DB::table('heroes')->get();
        echo "get heroes";
    }

    public function updateHero(array $hero) {
        if (!array_key_exists('id',$hero)) {
            return 0;
        }
        $id = $hero['id'];
        unset($hero['id']);
        return DB::table('heroes')->where('id','=',$id)->update($hero);
    }

    public function saveHero(array $hero) {
        return DB::table('heroes')->insertGetId($hero);
    }

    public function deleteHero($id) {
        return DB::table('heroes')->where('id','=',$id)->delete();
    }

}