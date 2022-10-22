<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $result = DB::select('select ativo from usuarios where email = :email and ativo = 1', ['email'=>$request->email]);
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

    /**
     * @OA\Delete(
     *     path="/api/login/{id}",
     *     description="Desativa Usuário por Id",
     *     operationId="InativaUsuarioById",
     *     security={{"bearerAuth": {}}},
     *     tags={"login"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             format="int64",
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="usuario deletado"
     *     ),
     * )
     * 
     * 
     */
    public function destroy(int $id)
    {
        $user = $this->user->find($id);
        if ($user === null) {
            return response()->json(["error" => "Impossivel realizar exclusão, pois recurso não existe"], 404);
        }
        $user->ativo = 0;
        $user->save();

        return response()->json(["msg" => "O usuário foi desativado"], 201);
    }

}
