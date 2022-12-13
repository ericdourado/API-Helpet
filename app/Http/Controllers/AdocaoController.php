<?php

namespace App\Http\Controllers;

use App\Models\Adocao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdocaoController extends Controller
{
    public function __construct(Adocao $adocao)
    {
        $this->adocao = $adocao;
    }

    public function index(Request $request)
    {
        $adocao = $this->adocao;
        if($request->has('especie')) {
            $adocao = $adocao->where('especie',$request->especie);
        }
        
        return response()->json($adocao->get(), 201);
    }


    public function store(Request $request)
    {
        $adocao = $this->adocao->create([
            'adotante_usuario_id' => null,
            'anunciante_usuario_id' => $request->anunciante_usuario_id,
            'nome' => $request->nome,
            'especie' => $request->especie,
            'cor' => $request->cor,
            'porte' => $request->porte,
            'idade' => $request->idade,
            'adotado' => 0
        ]);

        return response()->json($adocao, 201);
    }

    public function show(int $id)
    {
        $adocao = $this->adocao->find($id);
        if ($adocao === null) {
            return response()->json(["error" => "Recurso pesquisado nao existe"], 404);
        }
        return response()->json($adocao, 200);
    }


    public function update(Request $request, int $id)
    {
        
        $adocao = $this->adocao->find($id);
        
        if ($adocao === null) {
            return response()->json(["error" => "Impossivel realizar alteração, pois recurso não existe"], 404);
        } 
        
        // // colocar rules aqui
        $adocao->fill($request->all());
        $adocao->save();
        return response()->json(["sucess" => "Usuário alterado com sucesso"], 200);
    }

}
