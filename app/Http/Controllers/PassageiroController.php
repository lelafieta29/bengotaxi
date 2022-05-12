<?php

namespace App\Http\Controllers;

use App\Models\Passageiro;
use Illuminate\Http\Request;
use App\Http\Requests\PassageiroRequest;
use App\Models\Proposta;
use App\Models\Solicitacao;
use App\Models\Viagem;

class PassageiroController extends Controller
{
    public function index()
    {
        $passageiros = Passageiro::orderBy('created_at', 'desc')->with('user')->get();
        return response([
            'passageiro' => $passageiros,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(PassageiroRequest $request)
    {
        Passageiro::create($request->all());

        return response([
            'message' => 'Passageiro criado com sucesso.',

        ], 200);
    }

    public function show($id)
    {
        $passageiro = Passageiro::find($id);

        if (!$passageiro) {
            return response([
                'message' => 'Passageiro não existe.',
            ], 403);
        }

        $passageiro = Passageiro::where('id', $id)->with('user')->get();

        return response([
            'passageiro' => $passageiro,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(PassageiroRequest $request, $id)
    {
        $passageiro = Passageiro::find($id);

        if (!$passageiro) {
            return response([
                'message' => 'Passageiro não existe.',
            ], 403);
        }

        $passageiro->update($request->all());

        return response([
            'message' => 'Passageiro actualizada com sucesso.',
            'passageiro' => $passageiro,
        ], 200);
    }

    public function destroy($id)
    {
        $passageiro = Passageiro::find($id);

        if (!$passageiro) {
            return response([
                'message' => 'Passageiro não existe.',
            ], 403);
        }

        $passageiro->delete();

        return response([
            'message' => 'Passageiro eliminado com sucesso.',
        ], 200);
    }
}
