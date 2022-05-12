<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Http\Requests\EnderecoRequest;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = [];
        if (auth()->user()->empresaTransportes != null) {
            $empresa_id = auth()->user()->empresaTransportes->id;
            $enderecos = Endereco::orderBy('created_at', 'desc')->with('distrito.municipio.provincia', 'empresa_transportes')->where('empresa_transportes_id', $empresa_id)->get();
        } else {
            $enderecos = Endereco::orderBy('created_at', 'desc')->with('distrito.municipio.provincia', 'empresa_transportes')->get();
        }

        return response([
            'enderecos' => $enderecos
        ]);
    }

    public function show($id)
    {
        $enderecos = Endereco::where('id', $id)->orderBy('created_at', 'desc')->with('distrito.municipio.provincia')->first()->get();

        return response([
            'enderecos' => $enderecos
        ]);
    }

    public function enderecosEmpresa($empresa_id)
    {
        $enderecos = Endereco::where('id', $empresa_id)->orderBy('created_at', 'desc')->with('distrito.municipio.provincia')->first()->get();

        return response([
            'enderecos' => $enderecos
        ]);
    }

    public function store(EnderecoRequest $request)
    {
        $endereco  = Endereco::create($request->all());

        return response([
            'message' => 'Endereco criado.',
            'endereco' => $endereco
        ]);
    }

    public function pesquisar($value)
    {
        $enderecos = Endereco::where('nome', 'like', '%' . $value . '%')->with('distrito.municipio.provincia')->get();

        return response(['enderecos' => $enderecos]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nome' => 'required|string|min:2',
                'descricao' => 'required|string',
            ]
        );

        $endereco = Endereco::find($id);

        if (!$endereco) {
            return response([
                'message' => 'Endereco não existe.',
            ], 403);
        }

        $endereco->update(
            [
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]
        );

        return response([
            'message' => 'Motorista actualizada com sucesso.',
            'endereco' => $endereco,
        ], 200);
    }

    public function destroy($id)
    {
        $endereco = Endereco::find($id);

        if (!$endereco) {
            return response([
                'message' => 'Endereco não existe.',
            ], 403);
        }

        $endereco->delete();

        return response([
            'message' => 'Endereco eliminada com sucesso.',
        ], 200);
    }
}
