<?php

namespace App\Http\Controllers;

use App\Models\EmpresaTransporte;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaTransporteRequest;

class EmpresaTransporteController extends Controller
{
    public function index()
    {
        $empresasTransportes = EmpresaTransporte::orderBy('created_at', 'desc')->with('user')->get();
        return response([
            'empresas' => $empresasTransportes,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(EmpresaTransporteRequest $request)
    {
        $empresa = EmpresaTransporte::create($request->all());

        $id = $empresa->user_id;

        $user = User::find($id);

        $user->update([
            'nome' => $user->nome,
            'email' => $user->email,
            'telefone' => $user->telefone,
            'perfil' => $user->perfil,
            'activo' => 1,
            ''
        ]);

        return response([
            'message' => 'Empresa criada com sucesso.',
        ], 200);
    }

    public function show($id)
    {
        $empresaTransporte = EmpresaTransporte::find($id);

        if (!$empresaTransporte) {
            return response([
                'message' => 'Empresa não existe.',
            ], 403);
        }

        $empresaTransporte = EmpresaTransporte::where('id', $id)->with('user')->get()->first();

        return response([
            'empresaTransporte' => $empresaTransporte,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(EmpresaTransporteRequest $request, $id)
    {
        $empresaTransporte = EmpresaTransporte::find($id);

        if (!$empresaTransporte) {
            return response([
                'message' => 'Veículo não existe.',
            ], 403);
        }

        $empresaTransporte->update($request->all());

        return response([
            'empresaTransporte' => 'Empresa actualizada com sucesso.',
        ], 200);
    }

    public function destroy($id)
    {
        $empresaTransporte = EmpresaTransporte::find($id);

        if (!$empresaTransporte) {
            return response([
                'message' => 'Empresa não existe.',
            ], 403);
        }

        $empresaTransporte->delete();

        return response([
            'message' => 'Empresa eliminada com sucesso.',
        ], 200);
    }
}
