<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscolaController;
use App\Models\Escola;

Route::get('/', function () {
    return view('escola.index');
})->name('escola.index');


Route::prefix('cadastrar')->group(function(){
    Route::get('/', [EscolaController::class, 'index'])->name('escola.cronograma'); //listar 
    Route::post('/', [EscolaController::class, 'store'])->name('escola.store'); //salvar 
    Route::get('/cadastro', [EscolaController::class, 'create'])->name('escola.cadastro'); //criar 
    Route::get('/{id}/edit', [EscolaController::class, 'edit'])->where('id', '[0-9]+')->name('escola.edit'); //editar 
    Route::put('/{id}', [EscolaController::class, 'update'])->where('id', '[0-9]+')->name('escola.update'); //editar 
    Route::delete('/{id}', [EscolaController::class, 'destroy'])->where('id', '[0-9]+')->name('escola.destroy'); //deletar 
    
});







Route::get('/cronograma/{dia}', function ($dia) {
    $dias_validos = ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'];

    if (!in_array($dia, $dias_validos)) {
        abort(404, "Dia inválido");
    }

    $dados = Escola::where('dia_semana', $dia)->get();
    return view('escola.cronograma', ['dados' => $dados, 'dia' => ucfirst($dia)]);
})->name('escola.inicial');
