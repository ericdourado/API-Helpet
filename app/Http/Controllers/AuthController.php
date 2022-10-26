<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"login"},
     *     summary="Recuperar token com login",
     *     security={{"bearerAuth": {}}},
     *     description="Create a new Course",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     * )
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     * 
     *     
     * )
     */
    public function login(Request $request)
    {
        $token = auth('api')->attempt($request->all(['email', 'password']));
        $result = DB::select('select ativo from users where email = :email and ativo = 1', ['email'=>$request->email]);
        // return response()->json([$result]);
        if ($token) 
        {
            if (isset($result[0]->ativo) == 1)
            {
                return response()->json(['token' => $token]);
            }else   
            {
                return response()->json(['error' => 'Usuário não se encontra ativo no sistema']);
            }
        }else 
        {
            return response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }
    }

    

}
