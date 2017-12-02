<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //
    public function create(Request $req) {
        $json = $req->getContent();
        $obj = json_decode($json,true);
        $user = new User();
        $user->name = $obj['name'];
        $user->email = $obj['email'];
        $user->password = md5($obj['password']);
        $result = $this->userService->create($user);
        return response()->json($user);

    }

    public function get($id) {
        $user = $this->userService->getUser($id);
        return response()->json($user);
    }

}
