<?php

namespace App\Http\Controllers;

use App\Models\Posicao;
use Illuminate\Http\Request;
use App\Http\Requests\PosicaoRequest;

class PosicaoController extends Controller
{
    public function index()
    {
        $posicoes = Posicao::with('solicitacoes')->orderBy('created_at', 'desc')->get();
        return response([
            'posicoes' => $posicoes,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(PosicaoRequest $request)
    {
        Posicao::create($request->all());

        return response([
            'message' => 'Posição criada com sucesso.',
        ], 200);
    }

    public function show($id)
    {
        $posicao = Posicao::find($id);

        if (!$posicao) {
            return response([
                'message' => 'Posião não existe.',
            ], 403);
        }

        $posicao = Posicao::where('id', $id)->with('user')->get();

        return response([
            'posicao' => $posicao,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(PosicaoRequest $request, $id)
    {
        $posicao = Posicao::find($id);

        if (!$posicao) {
            return response([
                'message' => 'Posição não existe.',
            ], 403);
        }

        $posicao->update($request->all());

        return response([
            'message' => 'Posição actualizada com sucesso.',
            'posicao' => $posicao,
        ], 200);
    }

    public function destroy($id)
    {
        $posicao = Posicao::find($id);

        if (!$posicao) {
            return response([
                'message' => 'Posicao não existe.',
            ], 403);
        }

        $posicao->delete();

        return response([
            'message' => 'Posição eliminado com sucesso.',
        ], 200);
    }
}
