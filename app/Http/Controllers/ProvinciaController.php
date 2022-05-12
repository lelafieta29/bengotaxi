<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Http\Requests\ProvinciaRequest;

class ProvinciaController extends Controller
{

    public function index()
    {
        $provincias = Provincia::with('municipios.distritos')->orderBy('created_at', 'desc')->get();

        return response([
            'provincias' => $provincias
        ]);
    }

    public function create()
    {
        return view('provincia.create');
    }

    public function store(ProvinciaRequest $request)
    {
        $provincia = Provincia::create($request->all());

        return response([
            'provincia' => $provincia,
            'message' => 'Cadastrado com sucesso'
        ], 200);
    }

    public function show($id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            return response([
                'message' => 'Provincia nao encontrada'
            ], 403);
        }

        return response([
            'provincia' => $provincia
        ], 200);
    }

    public function edit($id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            dd("Provincia nao existe");
        }

        return view('provincia.edit', compact('provincia'));
    }

    public function update(ProvinciaRequest $request, $id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            dd("Provincia nao existe");
        }

        $provincia->update($request->all());
        return response([
            'provincia' => $provincia
        ], 200);
    }

    public function destroy($id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            dd("Provincia nao existe");
        }

        $provincia->delete();
    }
}
