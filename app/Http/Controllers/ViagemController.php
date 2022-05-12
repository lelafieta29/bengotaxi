<?php

namespace App\Http\Controllers;

use App\Models\Viagem;
use App\Models\Motorista;
use Illuminate\Http\Request;
use App\Http\Requests\ViagemRequest;

class ViagemController extends Controller
{
    public function index()
    {
        $viagens = [];
        if (auth()->user()->perfil == 'motorista') {
            $motorista = Motorista::where('user_id', auth()->user()->id)->get()->first();
            $viagens = Viagem::orderBy('created_at', 'desc')->with('propostas.solicitacao.passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'motorista.user', 'motorista.empresa_transportes', 'veiculo', 'propostas.viagem.veiculo', 'propostas.viagem.motorista.user', 'propostas.viagem.endereco_destino.distrito.municipio.provincia', 'propostas.viagem.endereco_origem.distrito.municipio.provincia', 'propostas.solicitacao.endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.endereco_origem.distrito.municipio.provincia', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->where('motorista_id', $motorista->id)->where('status', '!=', 2)->get();
        } else {
            $viagens = Viagem::orderBy('created_at', 'desc')->with('propostas.solicitacao.passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'motorista.user', 'motorista.empresa_transportes', 'veiculo', 'propostas.viagem.veiculo', 'propostas.viagem.motorista.user', 'propostas.viagem.endereco_destino.distrito.municipio.provincia', 'propostas.viagem.endereco_origem.distrito.municipio.provincia', 'propostas.solicitacao.endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.endereco_origem.distrito.municipio.provincia', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->get();
        }

        //        
        return response([
            'viagens' => $viagens,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = [];

        $data['motorista_id'] = 0;

        if (auth()->user()->perfil == 'motorista') {
            $data = $request->validate([
                'endereco_origem_id' => 'required',
                'endereco_destino_id' => 'required',
                'tipo_viagem' => 'required|string',
                'situacao' => 'required|string',
                'origem' => 'required|string',
                'destino' => 'required|string',
                'hora_inicio' => 'required',
                'valor' => 'required',
                'status' => 'required',
                'veiculo_id' => 'required',
            ]);

            $data['motorista_id'] = auth()->user()->motorista->id;
        } else {
            $data = $request->validate([
                'endereco_origem_id' => 'required',
                'endereco_destino_id' => 'required',
                'tipo_viagem' => 'required|string',
                'situacao' => 'required|string',
                'origem' => 'required|string',
                'destino' => 'required|string',
                'hora_inicio' => 'required',
                'valor' => 'required',
                'status' => 'required',
                'veiculo_id' => 'required',
                'motorista_id' => 'required',
            ]);            //$data['motorista_id'] = $request->motorista->id;
        }

        $viagem = Viagem::create($data);

        return response([
            'message' => 'Viagem criada com sucesso.',
            'viagem' => $viagem
        ], 200);
    }

    public function viagemPassageiro()
    {
        //$propostas = Proposta::with('solicitacao.passageiro')->where('confirmacao_passageiro', 1)->where('motorista_id',)->get();

        //$viagemSIM = Viagem::with('propostas.solicitacao.passageiro')->where('id', $idViagem)->get();

        //$viagens = Viagem::orderBy('created_at', 'desc')->with('veiculo', 'motorista', 'motorista.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.passageiro.user')->where('id', $idViagem)->where('id', $idViagem)->get();
        $viagens = Viagem::orderBy('created_at', 'desc')->with('propostas.solicitacao.passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'motorista.user', 'veiculo', 'propostas.viagem.veiculo', 'propostas.viagem.motorista.user', 'propostas.viagem.endereco_destino.distrito.municipio.provincia', 'propostas.viagem.endereco_origem.distrito.municipio.provincia', 'propostas.solicitacao.endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.endereco_origem.distrito.municipio.provincia', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->where('motorista_id', auth()->user()->motorista->id)->where('vagas', '>', 0)->get();
        //$viagens = Viagem::orderBy('created_at', 'desc')->with('veiculo', 'motorista', 'motorista.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.passageiro.user')->where('motorista_id', auth()->user()->motorista->id)->where('vagas', '>', 0)->get();
        return response([
            'viagens' => $viagens
        ]);
    }

    public function viagensFeitas()
    {

        $viagens = Viagem::orderBy('created_at', 'desc')->with('propostas.solicitacao.passageiro.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'motorista.user', 'veiculo', 'propostas.viagem.veiculo', 'propostas.viagem.motorista.user', 'propostas.viagem.endereco_destino.distrito.municipio.provincia', 'propostas.viagem.endereco_origem.distrito.municipio.provincia', 'propostas.solicitacao.endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.endereco_origem.distrito.municipio.provincia', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia')->where('status', 2)->get();
        //$viagens = Viagem::orderBy('created_at', 'desc')->with('veiculo', 'motorista', 'motorista.user', 'endereco_origem.distrito.municipio.provincia', 'endereco_destino.distrito.municipio.provincia', 'propostas.solicitacao.passageiro.user')->where('motorista_id', auth()->user()->motorista->id)->where('vagas', '>', 0)->get();
        return response([
            'viagens' => $viagens
        ]);
    }

    public function show($id)
    {
        $viagem = Viagem::find($id);

        if (!$viagem) {
            return response([
                'message' => 'Motorista não existe.',
            ], 403);
        }

        $viagem = Viagem::where('id', $id)->with('motorista', 'veiculo')->get();

        return response([
            'viagem' => $viagem,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(ViagemRequest $request, $id)
    {
        $viagem = Viagem::find($id);

        if (!$viagem) {
            return response([
                'message' => 'Viagem não existe.',
            ], 403);
        }



        $viagem->update([
            'endereco_origem_id' => $request->endereco_origem_id,
            'endereco_destino_id' => $request->endereco_destino_id,
            'tipo_viagem' => $request->tipo_viagem,
            'situacao' =>  $request->situacao,
            'origem' =>  $request->origem,
            'destino' =>  $request->destino,
            'hora_inicio' => $request->hora_inicio,
            'valor' => $request->valor,
            'veiculo_id' => $request->veiculo_id,
            'status' => $request->status,
            'motorista_id' => auth()->user()->motorista->id
        ]);

        return response([
            'message' => 'Viagem actualizada com sucesso.',
            'viagem' => $viagem,
        ], 200);
    }

    public function destroy($id)
    {
        $viagem = Viagem::find($id);

        if (!$viagem) {
            return response([
                'message' => 'Viagem não existe.',
            ], 403);
        }

        $viagem->delete();

        return response([
            'message' => 'Viagem eliminada com sucesso.',
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $viagem = Viagem::find($id);

        if (!$viagem) {
            return response([
                'message' => 'True',
            ]);
        }

        $viagem->update($request->all());

        //        dd($viagem->update($request->all()));

        return response([
            'message' => 'Actualizado com sucesso.',
            'viagem' => $viagem,
        ]);
    }
}
