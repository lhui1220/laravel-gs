<?php

namespace App\Http\Controllers;

use App\Services\PayService;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    private $payService;

    public static $count = 0;

    public function __construct(PayService $payService)
    {
        $this->payService = $payService;
        self::$count++;
    }

    public function show(Request $request, $id = 0)
    {
        return "show reflection req={$request} id={$id}";
    }
}
