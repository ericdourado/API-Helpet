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

        if ($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }
    }

    // /**
    //  * * @OA\Get(
    //  *     path="/api/login",
    //  *     tags={"login"},
    //  *     summary="testando, apenas",
    //  *     security={{"bearerAuth": {}}},
    //  *     description="testando, apenas",
    //  *     @OA\Response(response="default", description="Welcome page")
    //  *
    //  * )
    //  *
    //  */

}
