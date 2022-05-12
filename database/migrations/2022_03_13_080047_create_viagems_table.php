<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viagens', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_viagem');
            $table->string('situacao');
            $table->string('origem');
            $table->string('destino');
            $table->integer('valor');
            $table->integer('vagas')->default(0);
            $table->time('hora_inicio');
            $table->integer('status')->default(1);
            $table->foreignId('motorista_id')->constrained()->cascadeOnDelete();
            $table->foreignId('veiculo_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('viagems');
    }
}
