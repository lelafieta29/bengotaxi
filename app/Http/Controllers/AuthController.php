<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passageiro;
use App\Models\Motorista;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register
    public function registar(Request $request)
    {
        // Validacoes
        $attrs = $request->validate([
            'nome' => 'required|string|min:2',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8',
            'telefone' => 'required|integer|unique:users,telefone',
        ]);

        // Criar Usuário
        $user = User::create([
            'nome' => $attrs['nome'],
            'email' => $attrs['email'],
            'activo' => 0,
            'telefone' => $attrs['telefone'],
            'password' => Hash::make($attrs['password'])
        ]);

        switch ($request->perfil) {
            case 'passageiro':
                Passageiro::create([
                    'user_id' => $user->id
                ]);
                break;
            case 'motorista':
                Motorista::create([
                    'user_id' => $user->id
                ]);
                break;
            case 'admin_empresa':

                break;
            case 'admin':

                break;

            default:

                break;
        }


        // Retornar Usuário & Token
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    // Login
    public function login(Request $request)
    {
        // Validacoes
        $attrs = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $data = [
            'email' => $attrs['email'],
            'password' => $attrs['password']
        ];

        // Verificar credencias
        if (!Auth::attempt($data)) {
            return response([
                'message' => 'Credencias Inválidas.',
            ], 403);
        }

        $user = AuthController::user();

        return response([
            'user' => $user->original['user'],
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    // Logout
    public function logout()
    {
        // Eliminar os tokens existente        
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout com sucesso.'
        ]);
    }

    // User
    public function user()
    {
        $user = User::with('passageiro', 'motorista', 'motorista.empresa_transportes')->where('id', auth()->user()->id)->get()->first();

        return response([
            'user' => $user,
        ], 200);
    }

    // Update
    public function update(Request $request)
    {
        $attrs = $request->validate([
            'password_actual' => 'required|string|min:8',
            'password_nova' => 'required|string|min:8',
        ]);

        if (!Hash::check($request->password_actual, auth()->user()->password)) {
            return response([
                'message' => 'Password incorreta'
            ], 404);
        }

        if ($attrs['password_nova'] == $attrs['password_actual']) {
            return response([
                'message' => 'Password actual não pode ser ingual a antiga'
            ], 422);
        }

        auth()->user()->update([
            'password' => Hash::make($attrs['password_nova'])
        ]);

        return response([
            'message' => 'Password Actualizada',
            'user' => auth()->user()
        ], 200);
    }

    public function myURL()
    {
        return true;
    }
}
