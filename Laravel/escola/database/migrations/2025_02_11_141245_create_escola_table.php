<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('alunos', function (Blueprint $table) {
            
            $table->id();

            // Aluno
            $table->string('nome_aluno',60);
            $table->enum('curso', ['first', 'onebot', 'techbot', 'autobo', 'gamebot', 'gamebotadv', 'gamebotexp', 'aibot', 'aibotadv', 'developer']);
            $table->string('instagram',60)->nullable();

            // Horário
            $table->enum('dia_semana', ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado']);
            $table->enum('horario', ['09:00-11:00', '13:00-15:00', '15:00-17:00', '08:00-10:00', '10:00-12:00']);

            // Novos campos
            $table->enum('tipo', ['Regular', 'Experimental', 'Reposição'])->default('Regular');
            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('alunos');
    }
};
