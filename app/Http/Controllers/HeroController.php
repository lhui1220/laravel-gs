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

    public function getHeroes() {
        $heroes = $this->heroService->getHeroes();
        return response()->json($heroes);
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
