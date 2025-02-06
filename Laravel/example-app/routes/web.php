<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogosController;


//criar um grupo de rotas todas as rotas teram um prefixo de jogos 
//eu crio uma grpo de jogos e o callback retorna uma função vazia 

Route::prefix('jogos')->group(function(){
    Route::get('/', [JogosController::class, 'index'])->name('jogos.index'); //listar todos os jogos
    Route::get('/create', [JogosController::class, 'create'])->name('jogos.create'); //criar um novo jogo
    Route::post('/store', [JogosController::class, 'store'])->name('jogos.store'); //salvar um novo jogo
    Route::get('/{id}', [JogosController::class, 'show'])->name('jogos.show'); //exibir um jogo
    Route::get('/{id}/edit', [JogosController::class, 'edit'])->name('jogos.edit'); //editar um jogo
    
});

Route::fallback(function(){
    return "Página não encontrada";
});

