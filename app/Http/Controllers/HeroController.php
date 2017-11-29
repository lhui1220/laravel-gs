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
        $this->heroService->getHeroes();
    }

    public function updateHero(Request $req, $id) {

    }

    public function deleteHero(Request $req) {

    }

    public function createHero(Request $req) {

    }
}
