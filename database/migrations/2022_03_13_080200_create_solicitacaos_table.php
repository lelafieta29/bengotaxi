<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->time('hora');
            $table->foreignId('passageiro_id')->constrained('passageiros')->cascadeOnDelete();
            $table->foreignId('endereco_origem_id')->constrained('enderecos')->cascadeOnDelete();
            $table->foreignId('endereco_destino_id')->constrained('enderecos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacaos');
    }
}
