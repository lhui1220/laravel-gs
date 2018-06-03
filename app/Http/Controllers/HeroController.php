<?php

namespace App\Http\Controllers;

use App\Services\HeroService;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    private $heroService;

    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }

    public function getHeroes(Request $req) {
        $heroes = $this->heroService->getHeroes();
        $etag_input = $req->header('If-None-Match');
        $etag = md5(json_encode($heroes));
        if ($etag_input == $etag) {
            return response('',304)->header('Cache-Control','no-store');
        } else {
            return response()->json($heroes)
                ->header('ETag',$etag)
                ->header('Cache-Control','no-store');
        }

    }

    public function updateHero(Request $req, $id) {
        $json = $req->getContent();
        $hero = json_decode($json,true);
        $success = $this->heroService->updateHero($id,$hero);
        if ($success) {
            return response()->json($hero,200);
        } else {
            return response()->json($hero,400);
        }
    }

    public function deleteHero(Request $req) {

    }

    public function createHero(Request $req) {
        $json = $req->getContent();
        $hero = json_decode($json,true);
        $id = $this->heroService->saveHero($hero);
        if ($id) {
            $hero['id'] = $id;
        }
        return response()->json($hero);
    }
}
