<?php

namespace App\Models\Veiculos\Manutencao;

use App\Models\Model;
use App\Casts\Dinheiro;
use App\Presenters\Veiculos\Manutencao\DespesaPresenter;

class Despesa extends Model implements
    \App\Contracts\ScopeFiltrarParaTabelaInterface,
    \App\Contracts\ScopeFiltrarParaAutocompleteInterface
{
    protected $table = 'manutencao_veicular_despesas';

    protected $fillable = [
        'manutencao_veicular_id',
        'tipo_id',
        'valor',
        'data_da_despesa',
    ];

    protected $dates = [
        'data_da_despesa',
    ];

    protected $casts = [
        'data_da_despesa' => 'date:d/m/Y',
        'valor' => Dinheiro::class,
    ];

    protected $presenter = DespesaPresenter::class;

    // relacionamentos

    public function tipo()
    {
        return $this->belongsTo(TipoDeDespesa::class)->withTrashed();
    }

    public function manutencao()
    {
        return $this->belongsTo(Manutencao::class, 'manutencao_veicular_id');
    }

    // scopes

    public function scopeFiltrarParaTabela($query, $filtros)
    {
        $q = $filtros['q'] ?? null;

        $query->whereHas('tipo', function ($query) use ($filtros) {
            $query->filtrarParaTabela($filtros);
        });

        if (!empty($filtros['manutencao']) && $filtros['manutencao']) {
            $query->where('manutencao_veicular_id', $filtros['manutencao']->id);
        }

        return $query;
    }

    public function scopeFiltrarParaAutocomplete($query, $q)
    {
        return $query->filtrarParaTabela(['q' => $q]);
    }
}
