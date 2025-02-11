<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('escola', function (Blueprint $table) {
            $table->id();

            // Aluno
            $table->string('nome_aluno');
            $table->string('curso');
            $table->string('instagram')->nullable();

            // Horário
            $table->enum('dia_semana', ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado']);
            $table->enum('horario', ['09-11', '13-15', '15-17', '08-10', '10-12']);

            // Chave estrangeira do aluno (para evitar duplicação de nomes)
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('escola')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('escola');
    }
};
