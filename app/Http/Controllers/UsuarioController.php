<?php

namespace App\Http\Controllers;

use App\Models\PerfilUsuario;
use App\Models\User;
use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function __construct(Usuario $usuario, User $user)
    {
        $this->usuario = $usuario;
        $this->user = $user;
    }

    /**
     *     @OA\Get(
     *     path="/api/usuario",
     *     tags={"usuarios"},
     *     summary="Recupera usuários",
     *     security={{"bearerAuth": {}}},
     *     description="Recupera usuários, apenas",

     *     @OA\Response(
     *         response=200,
     *         description="OK")
     *
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $this->user;
        if ($request->has('email')) {
            $user = $user->where('email', $request->email);
        }

        // $user = $this->user->with('usuario')->with('perfil');
        return response()->json($user->with('usuario')->with('perfil')->get(), 201);
    }


    /**
     * * @OA\Post(
     *     path="/api/usuario",
     *     tags={"usuarios"},
     *     summary="cadastra usuário",
     *     security={{"bearerAuth": {}}},
     *     description="cadastra usuário",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="cpfcnpj", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *              @OA\Property(property="endereco", type="string"),
     *              @OA\Property(property="dt_nascimento", type="date"),
     *              @OA\Property(property="cidade", type="string"),
     *              @OA\Property(property="bairro", type="string"),
     *              @OA\Property(property="numero", type="int"),
     *              @OA\Property(property="Tipo", type="int"),
     *              @OA\Property(property="perfil_id", type="int")
     *              
     * )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="OK",
     *     ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $usuario = $this->usuario->create([
                'cpfcnpj' => $request->cpfcnpj,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
                'dt_nascimento' => $request->dt_nascimento,
                'Tipo' => 1,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
                'numero' => $request->numero,

            ]);

            $user = $this->user->create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'ativo' => 1,
                'usuario_id' => $usuario->id,
                'perfil_id' => $request->perfil_id
            ]);
        } catch (Exception $e) {
            $verifica_email = DB::table('users')->where('email', $request->email)->first()->email; 
            if(($verifica_email != null)  or ($verifica_email != '') )
            {
                return response()->json('Email ja está cadastrado', 201);
            }
            return response()->json('Não foi possivel realizar esta operação', 201);

        }
        return response()->json($this->user->with('usuario')->with('perfil')->find($user->id), 201);
    }

    /**
     * /**
     *     @OA\Get(
     *     path="/api/usuario/{id}",
     *     tags={"usuarios"},
     *     operationId="findusuarioById",
     *     summary="Recupera usuários",
     *     security={{"bearerAuth": {}}},
     *     description="Recupera usuários",
     *     @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *
     * )
     * @param  \App\Models\Usuario  $usuario
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = $this->user->with('usuario')->with('perfil')->find($id);
        if ($user === null) {
            return response()->json(["error" => "Recurso pesquisado nao existe"], 404);
        }
        return response()->json($user, 200);
    }


    /**
     ** @OA\Put(
     *      path="/api/usuario/{id}",
     *      operationId="updateUsuario",
     *      tags={"usuarios"},
     *      summary="Atualiza dados de usuário",
     *      security={{"bearerAuth": {}}},
     *      description="Atualiza dados de usuário",
     *      @OA\Parameter(
     *          name="id",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="usuario",type="array",
     *              @OA\Items(
     *              
     *              
     *              
     *              @OA\Property(property="cpfcnpj", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *              @OA\Property(property="endereco", type="string"),
     *              @OA\Property(property="dt_nascimento", type="date"),
     *              @OA\Property(property="cidade", type="string"),
     *              @OA\Property(property="bairro", type="string"),
     *              @OA\Property(property="numero", type="int"),
     *              @OA\Property(property="Tipo", type="int"),
     *              
     *              ),
     *          ),
     *              @OA\Property (property="login",type="array", 
     *              @OA\Items(
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="password", type="string"),
     *                  @OA\Property(property="perfil_id", type="int"),
     *                  @OA\Property(property="ativo", type="boolean"),
     *                  
     *              ),
     *              ),
     *              
     *          )
     * ),
     *     
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *       ),
     * )
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $user = $this->user->find($id);
        $usuarioId = DB::table('users')->where('id', $id)->first()->id;
        $usuario = $this->usuario->find($usuarioId);

        if ($user === null) {
            return response()->json(["error" => "Impossivel realizar alteração, pois recurso não existe"], 404);
        }
        // colocar rules aqui
        $user->fill($request->login[0]);
        $usuario->fill($request->usuario[0]);
        $user->save();
        $usuario->save();

        return response()->json(["sucess" => "Usuário alterado com sucesso"], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/usuario/{id}",
     *     description="Desativa Usuário por Id",
     *     operationId="InativaUsuarioById",
     *     security={{"bearerAuth": {}}},
     *     tags={"usuarios"},
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
        $user = $this->user->with('usuario')->with('perfil')->find($id);
        if ($user === null) {
            return response()->json(["error" => "Impossivel realizar exclusão, pois recurso não existe"], 404);
        }
        $user->ativo = 0;
        $user->save();

        return response()->json(["msg" => "O usuário foi desativado"], 201);
    }
}
