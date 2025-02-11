<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogosController;


//criar um grupo de rotas todas as rotas teram um prefixo de jogos 
//eu crio uma grpo de jogos e o callback retorna uma função vazia 

Route::prefix('jogos')->group(function(){
    Route::get('/', [JogosController::class, 'index'])->name('jogos.index'); //listar todos os jogos
    Route::get('/create', [JogosController::class, 'create'])->name('jogos.create'); //criar um novo jogo
    Route::post('/', [JogosController::class, 'store'])->name('jogos.store'); //salvar um novo jogo
    Route::get('/{id}/edit', [JogosController::class, 'edit'])->where('id', '[0-9]+')->name('jogos.edit'); //editar um jogo
    Route::put('/{id}', [JogosController::class, 'update'])->where('id', '[0-9]+')->name('jogos.update'); //editar um jogo
    Route::delete('/{id}', [JogosController::class, 'destroy'])->where('id', '[0-9]+')->name('jogos.destroy'); //deletar um jogo
    
});

Route::fallback(function(){
    return "Página não encontrada";
});

