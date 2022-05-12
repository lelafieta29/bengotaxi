<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('id', '!=', auth()->user()->id)->get();

        return response([
            'usuarios' => $users
        ]);
    }

    public function usuariosEmpresas()
    {
        $users = User::orderBy('created_at', 'desc')->where('perfil', 'admin_empresa')->where('activo', 0)->get();

        return response([
            'usuarios' => $users
        ]);
    }

    public function usuariosMotoristas()
    {
        $users = User::orderBy('created_at', 'desc')->where('perfil', 'motorista')->where('activo', 0)->get();

        return response([
            'usuarios' => $users
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
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'nome' => 'required|string|min:2',
            'email' => 'required|string|unique:users,email',
            'perfil' => 'required',
            'password' => 'required|string|min:8',
            'telefone' => 'required|integer|unique:users,telefone',
        ]);

        // Criar Usuário
        $user = User::create([
            'nome' => $attrs['nome'],
            'email' => $attrs['email'],
            'activo' => 0,
            'telefone' => $attrs['telefone'],
            'perfil' => $attrs['perfil'],
            'password' => Hash::make($attrs['password'])
        ]);



        // Retornar Usuário & Token
        return response([
            'message' => 'Usuário criado com sucesso.',
            'user' => $user,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {                                                               //->where('activo', 1)
        $usuario = User::where('id', $id)->with('empresaTransportes')->get();

        return response([
            'usuario' => $usuario
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response([
                'message' => 'Usuario nao existente.'
            ], 403);
        }

        $user->delete();

        return response([
            'message' => 'Usuario eliminado com sucesso.'
        ], 200);
    }
}
