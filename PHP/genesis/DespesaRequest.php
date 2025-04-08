<?php

namespace App\Http\Requests\Veiculos\Manutencao;

use App\Rules\Dinheiro as DinheiroRule;
use Illuminate\Foundation\Http\FormRequest;

class DespesaRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação da requisição.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'despesa.tipo_id' => 'required|exists:App\Models\Veiculos\Manutencao\TipoDeDespesa,id',
            'despesa.valor' => ['required', new DinheiroRule],
            'despesa.data_da_despesa' => 'required|date_format:d/m/Y',
        ];
    }

    /**
     * Nomes legíveis para os atributos.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'despesa.manutencao_veicular_id' => 'manutenção',
            'despesa.tipo_id' => 'despesa',
            'despesa.valor' => 'valor',
            'despesa.data_da_despesa' => 'data da despesa',
        ];
    }
}
