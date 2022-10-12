<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $token = auth('api')->attempt($request->all(['email','password']));
    
        if ($token) {
            return response()->json(['token' => $token]);
        }else{
            return response()->json(['erro'=> 'Usuário ou senha inválido'], 403);
        }
    }


    public function index()
    {
        $usersRepository = new UsersRepository($this->user);
        return response()->json($usersRepository->getResultado(),200);
    }
}