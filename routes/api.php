<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AvaliacaoController,
    AlertaController,
    AuthController,
    PassageiroController,
    PosicaoController,
    PropostaController,
    MotoristaController,
    SolicitacaoController,
    VeiculoController,
    ViagemController,
    EmpresaTransporteController,
    LocalizacaoController,
    EnderecoController,
    UsuarioController,
    MunicipioController,
    DistritoController,
    ProvinciaController,
    FeedbackController,
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/registar', [AuthController::class, 'registar'])->name('registar');

Route::get('/myURL', [AuthController::class, 'myURL'])->name('myURL');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Mostrar detalhe do User
    Route::get('/passageiros', [PassageiroController::class, 'index'])->name('passageiros.index');
    Route::get('/passageiros/{id}', [PassageiroController::class, 'show'])->name('passageiros.show');
    Route::post('/passageiros', [PassageiroController::class, 'store'])->name('passageiros.store');
    Route::put('/passageiros/{id}', [PassageiroController::class, 'update'])->name('passageiros.update');
    Route::delete('/passageiros/{id}', [PassageiroController::class, 'destroy'])->name('passageiros.destroy');

    Route::get('/passageiros/viagem/{id}', [PassageiroController::class, 'passageiroViagem'])->name('passageiros.viagem');


    Route::apiResource('/localizacoes', LocalizacaoController::class);
    Route::apiResource('/posicoes', PosicaoController::class);



    Route::get('/distritos', [DistritoController::class, 'index']);
    Route::post('/distritos', [DistritoController::class, 'store']);
    Route::delete('/distritos/{id}', [DistritoController::class, 'destroy']);
    Route::get('/distritosMunicipio/{id}', [DistritoController::class, 'distritosMunicipio']);

    Route::get('/municipios', [MunicipioController::class, 'index']);
    Route::post('/municipios', [MunicipioController::class, 'store']);
    Route::delete('/municipios/{id}', [MunicipioController::class, 'destroy']);
    Route::get('/municipiosProvincia/{id}', [MunicipioController::class, 'municipiosProvincia']);


    Route::get('/provincias', [ProvinciaController::class, 'index']);
    Route::post('/provincias', [ProvinciaController::class, 'store']);
    Route::delete('/provincias/{id}', [ProvinciaController::class, 'destroy']);

    Route::get('/motoristas', [MotoristaController::class, 'index']);
    Route::post('/motoristas', [MotoristaController::class, 'store']);
    Route::get('/motoristas/{id}', [MotoristaController::class, 'show']);
    Route::put('/motoristas/{id}', [MotoristaController::class, 'update']);
    Route::delete('/motoristas/{id}', [MotoristaController::class, 'destroy']);

    Route::get('/motoristasEmpresas', [MotoristaController::class, 'motoristasEmpresas']);

    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

    Route::get('/usuariosEmpresas', [UsuarioController::class, 'usuariosEmpresas']);
    Route::get('/usuariosMotoristas', [UsuarioController::class, 'usuariosMotoristas']);


    Route::apiResource('/veiculos', VeiculoController::class);
    Route::apiResource('/feedbacks', FeedbackController::class);

    //Route::apiResource('/empresas', EmpresaTransporteController::class);
    Route::get('/empresas', [EmpresaTransporteController::class, 'index']);
    Route::post('/empresas', [EmpresaTransporteController::class, 'store']);
    Route::get('/empresas/{id}', [EmpresaTransporteController::class, 'show']);
    Route::delete('/empresas/{id}', [EmpresaTransporteController::class, 'destroy']);

    Route::get('/avaliacoes/motorista/{id}', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');
    Route::get('/avaliacoes/{id}', [AvaliacaoController::class, 'show'])->name('avaliacoes.show');
    Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
    Route::put('/avaliacoes/{id}', [AvaliacaoController::class, 'update'])->name('avaliacoes.update');
    Route::delete('/avaliacoes/{id}', [AvaliacaoController::class, 'destroy'])->name('avaliacoes.destroy');



    Route::get('/solicitacoes', [SolicitacaoController::class, 'index'])->name('solicitacoes.index');
    Route::get('/solicitacoes/{id}', [SolicitacaoController::class, 'show'])->name('solicitacoes.show');
    Route::post('/solicitacoes', [SolicitacaoController::class, 'store'])->name('solicitacoes.store');
    Route::put('/solicitacoes/{id}', [SolicitacaoController::class, 'update'])->name('solicitacoes.update');
    Route::delete('/solicitacoes/{id}', [SolicitacaoController::class, 'destroy'])->name('solicitacoes.destroy');

    Route::get('/solicitacao', [SolicitacaoController::class, 'minhaSolicitacao'])->name('solicitacoes.minhaSolicitacao');

    Route::get('/viagens', [ViagemController::class, 'index'])->name('viagens.index');
    Route::get('/viagens/{id}', [ViagemController::class, 'show'])->name('viagens.show');
    Route::post('/viagens', [ViagemController::class, 'store'])->name('viagens.store');
    Route::put('/viagens/{id}', [ViagemController::class, 'update'])->name('viagens.update');
    Route::delete('/viagens/{id}', [ViagemController::class, 'destroy'])->name('viagens.destroy');

    Route::get('/viagem/passageiros', [ViagemController::class, 'viagemPassageiro'])->name('viagens.viagemPassageiro');

    Route::get('/viagem/feitas', [ViagemController::class, 'viagensFeitas'])->name('viagens.viagensFeitas');

    Route::put('/viagens/updateStatus/{id}', [ViagemController::class, 'updateStatus'])->name('viagens.updateStatus');


    Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');
    Route::get('/alertasAdmin', [AlertaController::class, 'indexAdmin'])->name('alertas.indexAdmin');
    Route::get('/alertas/chamada', [AlertaController::class, 'indexChamada'])->name('alertas.chamada');
    Route::post('/alertas', [AlertaController::class, 'store'])->name('alertas.store');

    Route::get('/alertas/listarAlertas', [AlertaController::class, 'listarAlertas'])->name('alertas.listarAlertas');
    Route::get('/alertas/listarAlertasChamada', [AlertaController::class, 'listarAlertasChamada'])->name('alertas.listarAlertasChamada');

    Route::put('/alertas/lerAlertas', [AlertaController::class, 'lerAlertas'])->name('alertas.lerAlertas');
    Route::put('/alertas/lerAlertasChamada', [AlertaController::class, 'lerAlertasChamada'])->name('alertas.lerAlertasChamada');

    Route::get('/propostas', [PropostaController::class, 'index'])->name('propostas.index');
    Route::post('/propostas', [PropostaController::class, 'store'])->name('propostas.store');
    Route::put('/propostas/{id}', [PropostaController::class, 'update'])->name('propostas.update');
    Route::get('/propostas/aceite', [PropostaController::class, 'aceite'])->name('propostas.aceite');

    Route::get('/propostasViagensRealizadas', [PropostaController::class, 'propostasViagensRealizadas'])->name('propostas.propostasViagensRealizadas');

    //Route::apiResource('/enderecos', EnderecoController::class);
    Route::get('/enderecos', [EnderecoController::class, 'index']);
    Route::post('/enderecos', [EnderecoController::class, 'store']);
    Route::get('/enderecos/{id}', [EnderecoController::class, 'show']);
    Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy']);
    Route::get('/enderecos/pesquisar/{value}', [EnderecoController::class, 'pesquisar']);
    Route::get('/enderecosEmpresa/{value}', [EnderecoController::class, 'enderecosEmpresa']);
    Route::put('/enderecos/{id}', [EnderecoController::class, 'update']);
});
