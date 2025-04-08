<?php

//status service

namespace App\Services\Models\Veiculos\Manutencao;

use App\Contracts\Models\Veiculos\Manutencao\DespesaServiceInterface;
use App\Services\BaseModelService;
use Illuminate\Support\Arr;
use DB;

class DespesaService extends BaseModelService implements DespesaServiceInterface
{
    public function model()
    {
        return \App\Models\Veiculos\Manutencao\Despesa::class;
    }

    public function create($dados)
    {
        DB::beginTransaction();

        $despesa = parent::create($dados);

        if (key_exists('anexo', $dados) && $dados['anexo']) {
            $despesa->addMedia($dados['anexo'])
                ->toMediaCollection('anexo');
        }

        DB::commit();
        return $despesa;
    }

    public function update($despesa, $dados)
    {
        DB::beginTransaction();

        $despesa = parent::update($despesa, $dados);

        if (key_exists('anexo', $dados) && $dados['anexo']) {
            $despesa->addMedia($dados['anexo'])
                ->toMediaCollection('anexo');
        }

        DB::commit();
    }
}
