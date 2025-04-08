<?php 

    Route::resource('manutencao_veicular.despesas', 'Veiculos\Manutencao\DespesaController')
    ->parameters(['manutencao_veicular' => 'manutencao', 'despesas' => 'despesa']);
