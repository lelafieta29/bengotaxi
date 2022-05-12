<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlertaRequest;
use App\Models\Alerta;
use App\Models\User;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexAdmin()
    {
        $alertas = Alerta::orderBy('created_at', 'desc')->with('user_destinatario', 'user_remetente')->get();

        return response([
            'alertas' => $alertas,
            'count' => $alertas->count()
        ]);
    }

    public function index()
    {
        $alertas = Alerta::orderBy('created_at', 'desc')->where('tipo', '!=', 'Chamada')->where('lida', 0)->where('user_destinatario_id', auth()->user()->id)->with('user_destinatario', 'user_remetente')->get();

        return response([
            'alertas' => $alertas,
            'count' => $alertas->count()
        ]);
    }

    public function indexChamada()
    {
        $alertas = Alerta::orderBy('created_at', 'desc')->where('tipo', 'Chamada')->where('lida', 0)->where('user_destinatario_id', auth()->user()->id)->with('user_destinatario', 'user_remetente')->get();

        return response([
            'alertas' => $alertas,
            'count' => $alertas->count()
        ]);
    }

    public function listarAlertas()
    {
        $alertas = Alerta::orderBy('created_at', 'desc')->where('user_destinatario_id', auth()->user()->id)->with('user_destinatario', 'user_remetente')->get();

        return response([
            'alertas' => $alertas,
        ]);
    }

    public function listarAlertasChamada()
    {
        $alertas = Alerta::orderBy('created_at', 'desc')->where('tipo', 'Chamada')->where('user_destinatario_id', auth()->user()->id)->with('user_destinatario', 'user_remetente')->get();

        return response([
            'alertas' => $alertas,
        ]);
    }


    public function lerAlertas()
    {
        $alertas = Alerta::where('user_destinatario_id', auth()->user()->id);

        $alertas->update(['lida' => 1]);

        return response([
            'message' => 'Lida com sucesso.',
        ]);
    }

    public function lerAlertasChamada()
    {
        $alertas = Alerta::where('user_destinatario_id', auth()->user()->id)->where('tipo', 'Chamada');

        $alertas->update(['lida' => 1]);

        return response([
            'message' => 'Lida com sucesso.',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlertaRequest $request)
    {

        $alerta = Alerta::create($request->all());

        return response([
            'alerta' => $alerta,
            'message' => 'Alerta criada com sucesso.',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function edit(Alerta $alerta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alerta $alerta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alerta $alerta)
    {
        //
    }
}
