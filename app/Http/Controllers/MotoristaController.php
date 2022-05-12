<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\MotoristaRequest;
use App\Models\EmpresaTransporte;
use Illuminate\Support\Facades\Hash;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = [];
        if (auth()->user()->empresaTransportes == null) {
            $motoristas = Motorista::orderBy('created_at', 'desc')->with('user', 'viagens.propostas.avaliacoes.user', 'empresa_transportes')->get();
        } else {
            $empresa = EmpresaTransporte::where('user_id', auth()->user()->id)->get()->first();
            $motoristas = Motorista::orderBy('created_at', 'desc')->with('user', 'viagens.propostas.avaliacoes.user', 'empresa_transportes')->where('empresa_transportes_id', $empresa->id)->get();
        }



        return response([
            'motoristas' => $motoristas,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function motoristasEmpresas()
    {
        $empresa = EmpresaTransporte::where('user_id', auth()->user()->id)->get()->first();

        $motoristas = Motorista::orderBy('created_at', 'desc')->with('user', 'empresa_transportes')->where('empresa_transportes_id', $empresa->id)->get();
        return response([
            'motoristas' => $motoristas,
        ], 200);
    }

    public function store(MotoristaRequest $request)
    {
        $usuario = User::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'activo' => 1,
            'perfil' => 'motorista',
            'telefone' => $request['telefone'],
            'password' => Hash::make($request['password'])
        ]);

        $motorista = Motorista::create([
            'bi' => $request->bi,
            'carta_conducao' => $request->carta_conducao,
            'distrito_id' => $request->distrito_id,
            'nascimento' => $request->nascimento,
            'user_id' => $usuario->id,
            'empresa_transportes_id' => $request->empresa_transportes_id
        ]);

        return response([
            'message' => 'Motorista criado com sucesso.',
            'motorista' => $motorista
        ], 200);
    }

    public function show($id)
    {
        $motorista = Motorista::find($id);

        if (!$motorista) {
            return response([
                'message' => 'Motorista não existe.',
            ], 403);
        }

        $motorista = Motorista::where('id', $id)->with('user')->get();

        return response([
            'motorista' => $motorista,
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'nome' => 'required|string|min:2',
                'bi' => 'required|string|size:14',
                'carta_conducao' => 'required|string|min:2',
                'email' => 'required|string',
                'telefone' => 'required|integer',
                'password' => 'required|min:8',
                'nascimento' => 'required|date',
            ]
        );

        $motorista = Motorista::find($id);

        if (!$motorista) {
            return response([
                'message' => 'Motorista não existe.',
            ], 403);
        }

        $user = User::where('id', $motorista->user_id)->get()->first();

        $motorista->update(
            [
                'bi' => $request->bi,
                'carta_conducao' => $request->carta_conducao,
            ]
        );


        $user->update(
            [
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->email,
            ]
        );


        return response([
            'message' => 'Motorista actualizada com sucesso.',
            'motorista' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        $motorista = Motorista::find($id);

        if (!$motorista) {
            return response([
                'message' => 'Motorista não existe.',
            ], 403);
        }

        $motorista->delete();

        return response([
            'message' => 'Motorista eliminado com sucesso.',
        ], 200);
    }
}
