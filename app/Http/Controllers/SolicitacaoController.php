<?php

namespace App\Http\Controllers;

use App\Models\Proposta;
use App\Models\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SolicitacaoRequest;

class SolicitacaoController extends Controller
{
    public function index()
    {

        $data = [];
        $propostas = Proposta::all();
        foreach ($propostas as $value) {
            array_push($data, $value->solicitacao_id);
        }

        //$solicitacoes = Solicitacao::with('passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->where('passageiro_id', auth()->user()->passageiro->id)->get();
        $solicitacoes = Solicitacao::orderBy('created_at', 'desc')->with('passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->whereNotIn('id', $data)->get();
        //dd($solicitacao->id);

        //$solicitacoes = Proposta::with('viagem.motorista', 'viagem.veiculo', 'viagem.endereco_origem.distrito.municipio.provincia', 'viagem.endereco_destino.distrito.municipio.provincia')->with('solicitacao.endereco_origem.distrito.municipio.provincia', 'solicitacao.endereco_destino.distrito.municipio.provincia', 'solicitacao.passageiro.user')->where('confirmacao_passageiro', 0)->where('solicitacao_id', $solicitacao->id)->orderBy('created_at', 'desc')->get();
        return response([
            'solicitacoes' => $solicitacoes,
        ], 200);
    }

    public function minhaSolicitacao()
    {
        $data = [];
        $propostas = Proposta::all();
        foreach ($propostas as $value) {
            if ($value->confirmacao_passageiro == 1) {
                array_push($data, $value->solicitacao_id);
            }
        }

        array_push($data, 0);


        //$solicitacoes = Solicitacao::with('passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->where('passageiro_id', auth()->user()->passageiro->id)->get();
        $solicitacao = Solicitacao::with('passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->orderBy('created_at', 'desc')->whereNotIn('id', $data)->get();
        //dd($solicitacao->id);

        //$solicitacoes = Proposta::with('viagem.motorista', 'viagem.veiculo', 'viagem.endereco_origem.distrito.municipio.provincia', 'viagem.endereco_destino.distrito.municipio.provincia')->with('solicitacao.endereco_origem.distrito.municipio.provincia', 'solicitacao.endereco_destino.distrito.municipio.provincia', 'solicitacao.passageiro.user')->where('confirmacao_passageiro', 0)->where('solicitacao_id', $solicitacao->id)->orderBy('created_at', 'desc')->get();
        return response([
            'solicitacao' => $solicitacao,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(SolicitacaoRequest $request)
    {

        $data = [];
        $data = $request->all();
        $data['passageiro_id'] = auth()->user()->passageiro->id;


        $solicitacao = Solicitacao::create($data);



        return response([
            'solicitacao' => $solicitacao,
            'message' => 'Solicitação feita.',
        ], 200);
    }

    public function show($id)
    {
        $solicitacao = Solicitacao::find($id);

        if (!$solicitacao) {
            return response([
                'message' => 'Solicitação não existe.',
            ], 403);
        }

        $solicitacao = Solicitacao::orderBy('created_at', 'desc')->get();

        return response([
            'solicitacao' => $solicitacao,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(SolicitacaoRequest $request, $id)
    {
        $solicitacao = Solicitacao::find($id);

        if (!$solicitacao) {
            return response([
                'message' => 'Solicitação não existe.',
            ], 403);
        }

        $solicitacao->update($request->all());

        return response([
            'message' => 'Solicitaçao actualizada com sucesso.',
            'solicitacao' => $solicitacao,
        ], 200);
    }

    public function destroy($id)
    {
        $solicitacao = Solicitacao::find($id);

        if (!$solicitacao) {
            return response([
                'message' => 'Solicitaçao não existe.',
            ], 403);
        }

        $solicitacao->delete();

        return response([
            'message' => 'Solicitaçao eliminado com sucesso.',
        ], 200);
    }
}
