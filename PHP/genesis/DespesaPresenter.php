<?php

namespace App\Presenters\Veiculos\Manutencao;

use App\Presenters\Hyphenizer;
use Laracasts\Presenter\Presenter;
use App\Presenters\ApresentadorTrait;

class DespesaPresenter extends Presenter
{
    use Hyphenizer, ApresentadorTrait;

    public function data_da_despesa()
    {
        return $this->apresentarData($this->entity->data_da_despesa);
    }

    public function valor()
    {
        return $this->apresentarDinheiro($this->entity->valor);
    }
}
