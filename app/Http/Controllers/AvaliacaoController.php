<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Proposta;
use App\Models\Viagem;
use App\Models\Motorista;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{

    public function index($motorista_id)
    {
        $avaliacoes = Avaliacao::with('user', 'proposta.viagem.motorista')->where('motorista_id', $motorista_id)->get();

        return response([
            'avaliacoes' => $avaliacoes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avaliacao = Avaliacao::create($request->all());
        return response([
            'avaliacao' => $avaliacao,
            'message' => 'Avaliacao feita com sucesso.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposta = Proposta::find($id);

        if (!$proposta) {
            return response([
                'avaliacao' => null,
            ]);
        }

        $avaliacao = Avaliacao::with('user')->where('proposta_id', $proposta->id)->get();

        return response([
            'avaliacao' => $avaliacao,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Avaliacao $avaliacao)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $avaliacao = Avaliacao::find($id);

        if (!$avaliacao) {
            Avaliacao::create($request->all());
            return response([
                'avaliacao' => $avaliacao,
                'message' => 'Avaliacao feita com sucesso.'
            ]);
        }

        $avaliacao->update($request->all());

        return response([
            'avaliacao' => $avaliacao,
            'message' => 'Avaliacao actualizada com sucesso.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avaliacao  $avaliacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avaliacao $avaliacao)
    {
        //
    }
}
