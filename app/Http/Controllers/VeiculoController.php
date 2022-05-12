<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Motorista;
use Illuminate\Http\Request;
use App\Http\Requests\VeiculoRequest;
use App\Models\EmpresaTransporte;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = [];
        // ->where('empresa_transportes_id', auth()->user()->motorista->empresa_transportes_id)
        if (auth()->user()->perfil == 'admin') {
            $veiculos = Veiculo::orderBy('created_at', 'desc')->with('empresa_transportes.user')->get();
        } else {
            if (auth()->user()->perfil == 'admin_empresa') {
                $empresa = EmpresaTransporte::where('user_id', auth()->user()->id)->get()->first();
                $veiculos = Veiculo::orderBy('created_at', 'desc')->with('empresa_transportes.user')->where('empresa_transportes_id', $empresa->id)->get();
            } else {
                $motorista = Motorista::where('user_id', auth()->user()->id)->get()->first();
                $veiculos = Veiculo::orderBy('created_at', 'desc')->with('empresa_transportes.user')->where('empresa_transportes_id', $motorista->empresa_transportes_id)->get();
            }
        }
        return response([
            'veiculos' => $veiculos,
        ], 200);
    }

    public function veiculosEmpresa($empresa_id)
    {
        $veiculos = Veiculo::orderBy('created_at', 'desc')->with('motorista')->where('empresa_transportes_id', $empresa_id)->get();
        return response([
            'veiculos' => $veiculos,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(VeiculoRequest $request)
    {
        $veiculo = Veiculo::create($request->all());

        return response([
            'message' => 'Veículo criada com sucesso.',
            'veiculo' => $veiculo
        ], 200);
    }

    public function show($id)
    {
        $veiculos = Veiculo::orderBy('created_at', 'desc')->with('empresaTransportes')->where('empresa_transportes_id', $id)->get();
        return response([
            'veiculos' => $veiculos,
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
                'nome' => 'required|string',
                'ano' => 'required|integer',
                'descricao' => 'required|string',
                'cor' => 'required|string',
                'capacidade' => 'required|integer',
                'ultima_revisao' => 'required',
            ]
        );

        $veiculo = Veiculo::find($id);

        if (!$veiculo) {
            return response([
                'message' => 'Veiculo não existe.',
            ], 403);
        }

        $veiculo->update(
            [
                'nome' => $request->nome,
                'ano' => $request->ano,
                'descricao' => $request->descricao,
                'cor' => $request->cor,
                'capacidade' => $request->capacidade,
                'ultima_revisao' => $request->ultima_revisao,
            ]
        );

        return response([
            'message' => 'Motorista actualizada com sucesso.',
            'veiculo' => $veiculo,
        ], 200);
    }

    public function destroy($id)
    {
        $veiculo = Veiculo::find($id);

        if (!$veiculo) {
            return response([
                'message' => 'Veículo não existe.',
            ], 403);
        }

        $veiculo->delete();

        return response([
            'message' => 'Vículo eliminada com sucesso.',
        ], 200);
    }
}
