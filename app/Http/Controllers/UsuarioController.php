<?php

namespace App\Http\Controllers;

use App\Models\PerfilUsuario;
use App\Models\User;
use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function __construct(Usuario $usuario, PerfilUsuario $perfilUsuario, User $user)
    {
        $this->usuario = $usuario;
        $this->perfilUsuario = $perfilUsuario;
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
    public function index()
    {
        $usuarioRepository = new UsuarioRepository($this->usuario);
        $usuarioRepository->selectAtributosRegistrosRelacionados('user'); 
        return response()->json($usuarioRepository->getResultado(), 201);
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
     *              @OA\Property(property="cpf", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *              @OA\Property(property="endereco", type="string"),
     *              @OA\Property(property="dt_nascimento", type="date"),
     *              @OA\Property(property="sexo", type="string"),
     *              @OA\Property(property="ativo", type="boolean"),
     *              @OA\Property(property="perfil_id", type="int"),
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
        $this->user->create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
        ]);
        $ultimoDadoBanco = DB::table('users')->orderBy('created_at', 'desc')->first();
        $id = $ultimoDadoBanco->id;
        $this->usuario->create([
            'nome' => $request->name,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'dt_nascimento' => $request->dt_nascimento,
            'sexo' => $request->sexo,
            'user_id' => $id,
            'ativo' => 1,
        ]);
        $ultimoDadoBanco = DB::table('usuarios')->orderBy('created_at', 'desc')->first();
        $id = $ultimoDadoBanco->id;
        $this->perfilUsuario->create([
            'usuario_id' => $id,
            'perfil_id' => $request->perfil_id
        ]);
        return response()->json($this->usuario->with('user')->find($id), 201);
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
        $usuario = $this->usuario->with('user')->find($id);
        if ($usuario === null) {
            return response()->json(["error" => "Recurso pesquisado nao existe"], 404);
        }
        return response()->json($usuario, 200);
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
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="nome", type="string"),
     *              @OA\Property(property="cpf", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *              @OA\Property(property="endereco", type="string"),
     *              @OA\Property(property="dt_nascimento", type="date"),
     *              @OA\Property(property="sexo", type="string"),
     *              @OA\Property(property="ativo", type="boolean"),
     *              @OA\Property(property="perfil_id", type="int"),
     *          )
     * ),
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
        $usuario = $this->usuario->with('user')->find($id);
        $user = $this->user->find($usuario->user_id);
        if ($usuario === null) {
            return response()->json(["error" => "Impossivel realizar alteração, pois recurso não existe"], 404);
        } 
        // colocar rules aqui
        $user->fill($request->all());
        $usuario->fill($request->all());
        $user->save();
        $usuario->save();
        
        return response()->json(["sucess"=>"Dados alterados com sucesso"], 200);
    }

   /**
     * @OA\Delete(
     *     path="/api/usuario/{id}",
     *     description="Deleta Usuário por Id",
     *     operationId="deleteUsuarioById",
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
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $usuario = $this->usuario->find($id);
        if ($usuario === null) {
            return response()->json(["error" => "Impossivel realizar exclusão, pois recurso não existe"], 404);
        }
        $usuario->ativo = 0;
        $usuario->save();
        // $this->usuario::where('id', $id)->update(['ativo' => 0]);
        return response()->json(["msg" => "O usuário foi desativado"], 201);
    }
}
