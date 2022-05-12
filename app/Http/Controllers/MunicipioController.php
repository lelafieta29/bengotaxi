<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipioRequest;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::with('distritos', 'provincia')->orderBy('created_at', 'desc')->get();

        return response([
            'municipios' => $municipios
        ], 200);
    }
    public function municipiosProvincia($provincia_id)
    {
        $municipios = Municipio::with('distritos', 'provincia')->orderBy('created_at', 'desc')->where('provincia_id', $provincia_id)->get();

        return response([
            'municipios' => $municipios
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
    public function store(MunicipioRequest $request)
    {
        $municipios = Municipio::create($request->all());

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
        $municipio = Municipio::find($id);

        if (!$municipio) {
            return response([
                'message' => $municipio,
            ], 403);
        }

        return response([
            'municipio' => $municipio,
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
        $municipio = Municipio::find($id);

        if (!$municipio) {
            return response([
                'municipio' => $municipio,
            ], 403);
        }

        return response([
            'municipio' => $municipio,
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
        $municipio = Municipio::find($id);

        if (!$municipio) {
            return response([
                'municipio' => $municipio,
            ], 403);
        }

        $municipio->delete();
    }
}
