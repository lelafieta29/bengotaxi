<?php

namespace App\Http\Controllers;

use App\Models\Localizacao;
use Illuminate\Http\Request;
use App\Http\Requests\LocalizacaoRequest;

class LocalizacaoController extends Controller
{
    public function index()
    {
        $localizacoes = Localizacao::orderBy('created_at', 'desc')->get();
        return response([
            'localizacoes' => $localizacoes,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(LocalizacaoRequest $request)
    {
        Localizacao::create($request->all());

        return response([
            'message' => 'Localizacao criada com sucesso.',
        ], 200);
    }

    public function show($id)
    {
        $localizacao = Localizacao::find($id);

        if (!$localizacao) {
            return response([
                'message' => 'Localização não existe.',
            ], 403);
        }

        $localizacao = Localizacao::where('id', $id)->with('user')->get();

        return response([
            'localizacao' => $localizacao,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(LocalizacaoRequest $request, $id)
    {
        $localizacao = Localizacao::find($id);

        if (!$localizacao) {
            return response([
                'message' => 'Localização não existe.',
            ], 403);
        }

        $localizacao->update($request->all());

        return response([
            'message' => 'Localização actualizada com sucesso.',
            'localizacao' => $localizacao,
        ], 200);
    }

    public function destroy($id)
    {
        $localizacao = Localizacao::find($id);

        if (!$localizacao) {
            return response([
                'message' => 'Localização não existe.',
            ], 403);
        }

        $localizacao->delete();

        return response([
            'message' => 'Localização eliminado com sucesso.',
        ], 200);
    }
}
