<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscolaController;
use App\Models\Escola;
use App\Http\Controllers\LoginController;

// Alteração aqui: Redireciona a rota '/' para '/login'
Route::get('/', function () {
    return redirect('/login');
});


Route::prefix('cronograma')->group(function(){
    Route::get('/', [EscolaController::class, 'index'])->name('escola.cronograma'); //listar 
    Route::post('/', [EscolaController::class, 'store'])->name('escola.store'); //salvar 
    Route::get('/cadastro', [EscolaController::class, 'create'])->name('escola.cadastro'); //criar 
    Route::get('/{id}/edit', [EscolaController::class, 'edit'])->where('id', '[0-9]+')->name('escola.edit'); //editar 
    Route::put('/{id}', [EscolaController::class, 'update'])->where('id', '[0-9]+')->name('escola.update'); //editar 
    Route::delete('/{id}', [EscolaController::class, 'destroy'])->where('id', '[0-9]+')->name('escola.destroy'); //deletar 
});

Route::get('/check-course-limit', [EscolaController::class, 'checkCourseLimit']);

Route::get('/cronograma/{dia}', function ($dia) {
    $dias_validos = ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'];

    if (!in_array($dia, $dias_validos)) {
        abort(404, "Dia inválido");
    }

    $dados = Escola::where('dia_semana', $dia)->get();
    return view('escola.cronograma', ['dados' => $dados, 'dia' => ucfirst($dia)]);
})->name('escola.inicial');

Route::get('/login', function () {
    return view('escola.login');
});
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout']);

