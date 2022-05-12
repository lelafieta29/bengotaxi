<?php

namespace App\Http\Controllers;

use App\Models\Proposta;
use Illuminate\Http\Request;
use App\Http\Requests\PropostaRequest;
use App\Models\Passageiro;
use App\Models\Solicitacao;
use App\Models\Viagem;
use Illuminate\Support\Facades\Auth;

class PropostaController extends Controller
{
    public function index()
    {
        $solicitacao = Solicitacao::where('passageiro_id', auth()->user()->passageiro->id)->get()->last();
        $propostas = [];

        if ($solicitacao) {
            $propostas = Proposta::with('avaliacoes.user', 'viagem.motorista.user', 'viagem.veiculo', 'viagem.endereco_origem.distrito.municipio.provincia', 'viagem.endereco_destino.distrito.municipio.provincia')->with('solicitacao.endereco_origem.distrito.municipio.provincia', 'solicitacao.endereco_destino.distrito.municipio.provincia', 'solicitacao.passageiro.user')->where('confirmacao_passageiro', 0)->where('solicitacao_id', $solicitacao->id)->get();
        }

        return response([
            'propostas' => $propostas,
        ], 200);
    }


    public function propostasViagensRealizadas()
    {
        $propostas = Proposta::with('avaliacao.user', 'viagem.motorista.user', 'viagem.veiculo', 'viagem.endereco_origem.distrito.municipio.provincia', 'viagem.endereco_destino.distrito.municipio.provincia')->with('solicitacao.endereco_origem.distrito.municipio.provincia', 'solicitacao.endereco_destino.distrito.municipio.provincia', 'solicitacao.passageiro.user')->get();
        return response([
            'propostas' => $propostas,
        ], 200);
    }

    public function propostasViagem($viagem_id)
    {

        $propostas = Proposta::with('avaliacao.user', 'viagem.motorista.user', 'viagem.veiculo', 'viagem.endereco_origem.distrito.municipio.provincia', 'viagem.endereco_destino.distrito.municipio.provincia')->with('solicitacao.endereco_origem.distrito.municipio.provincia', 'solicitacao.endereco_destino.distrito.municipio.provincia', 'solicitacao.passageiro.user')->where('confirmacao_passageiro', 1)->where('viagem_id', $viagem_id)->get();

        return response([
            'propostas' => $propostas,
        ], 200);
    }

    public function aceite()
    {
        $solicitacao = Solicitacao::orderBy('created_at', 'desc')->where('passageiro_id', auth()->user()->passageiro->id)->get()->first();

        $propostas = Proposta::with('avaliacao.user', 'viagem.motorista.user', 'viagem.veiculo', 'viagem.endereco_origem.distrito.municipio.provincia', 'viagem.endereco_destino.distrito.municipio.provincia')->with('solicitacao.endereco_origem.distrito.municipio.provincia', 'solicitacao.endereco_destino.distrito.municipio.provincia', 'solicitacao.passageiro.user')->where('confirmacao_passageiro', 1)->where('solicitacao_id', $solicitacao->id)->get();

        return response([
            'propostas' => $propostas,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(PropostaRequest $request)
    {
        Proposta::create($request->all());

        return response([
            'message' => 'Proposta criada com sucesso.',
        ], 200);
    }

    public function show($id)
    {
        $proposta = Proposta::find($id);

        if (!$proposta) {
            return response([
                'message' => 'Posião não existe.',
            ], 403);
        }

        $proposta = Proposta::where('id', $id)->with('user')->get();

        return response([
            'proposta' => $proposta,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $proposta = Proposta::where('id', $id)->with('viagem')->get()->first();

        if (!$proposta) {
            return response([
                'message' => 'Proposta não existe.',
            ], 403);
        }

        if ($proposta->viagem->vagas == $proposta->viagem->veiculo->capacidade) {
            return response([
                'message' => 'Nesta viagem já nao há espaco.',
            ], 403);
        }
        $proposta->update($request->all());

        $viagem = Viagem::find($proposta->viagem_id);

        $viagem->update([
            'vagas' => $viagem->vagas + 1
        ]);

        return response([
            'message' => 'Proposta actualizada com sucesso.',
            'proposta' => $proposta,
        ], 200);
    }

    public function destroy($id)
    {
        $proposta = Proposta::find($id);

        if (!$proposta) {
            return response([
                'message' => 'Posicao não existe.',
            ], 403);
        }

        $proposta->delete();

        return response([
            'message' => 'Proposta eliminado com sucesso.',
        ], 200);
    }
}
