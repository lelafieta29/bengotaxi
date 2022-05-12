<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao');
            $table->boolean('lida')->default(0);
            $table->boolean('lida_admin')->default(0);
            $table->enum('tipo', ['Aceitacao', 'Chamada', 'Avaliacao', 'Proposta', 'Viajar'])->nullable();
            $table->foreignId('user_destinatario_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_remetente_id')->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('alertas');
    }
}
