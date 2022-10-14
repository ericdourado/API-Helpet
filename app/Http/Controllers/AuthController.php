<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     description="Authentication Bearer Token",
 *     securityScheme="bearerAuth",
 *     name="Authentication Bearer Token",
 *     in="header",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth"
 * )
 */
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

    /**
     * * @OA\Get(
     *     path="/api/login",
     *     tags={"login"},
     *     summary="Recupera usuários cadastrados",
     *     security={{"bearerAuth": {}}},
     *     description="Recupera todos os usuarios cadastrados e seus dados",
     *     @OA\Response(response="default", description="Welcome page")
     *
     * )
     *
     */
    // public function index()
    // {
    //     $usersRepository = new UsersRepository($this->user);
    //     return response()->json($usersRepository->getResultado(), 200);
    // }
}
