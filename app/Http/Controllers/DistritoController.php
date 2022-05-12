<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistritoRequest;
use App\Models\Distrito;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distritos = Distrito::with('municipio.provincia')->orderBy('created_at', 'desc')->get();

        return response([
            'distritos' => $distritos
        ], 200);
    }

    public function distritosMunicipio($municipio_id)
    {
        $distritos = Distrito::with('municipio.provincia')->orderBy('created_at', 'desc')->where('municipio_id', $municipio_id)->get();

        return response([
            'distritos' => $distritos
        ], 200);
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
    public function store(DistritoRequest $request)
    {
        $distrito = Distrito::create($request->all());

        return response([
            'message' => 'Cadastrados com sucesso'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Distrito = Distrito::find($id);

        if (!$Distrito) {
            return response([
                'message' => $Distrito,
            ], 403);
        }

        return response([
            'Distrito' => $Distrito,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Distrito = Distrito::find($id);

        if (!$Distrito) {
            return response([
                'Distrito' => $Distrito,
            ], 403);
        }

        return response([
            'Distrito' => $Distrito,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Distrito = Distrito::find($id);

        if (!$Distrito) {
            return response([
                'Distrito' => $Distrito,
            ], 403);
        }

        $Distrito->delete();
    }
}
