<?php

namespace App\Services\Tables\Veiculos\Manutencao;

use App\Contracts\Models\Veiculos\Manutencao\DespesaServiceInterface;
use App\Contracts\Tables\Veiculos\Manutencao\DespesaTableServiceInterface;
use App\Models\Veiculos\Manutencao\Despesa;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DespesaTableService extends DataTable implements DespesaTableServiceInterface
{
    private $manutencao;

    public function responseAjax()
    {
        return $this->ajax();
    }

    public function setParams(array $params = [])
    {
        $this->params = $params;
        $this->manutencao = $params['manutencao_veicular'];
        return $this;
    }

    public function dataTable($query)
    {
        $usuario = auth()->user();

        return datatables()
            ->eloquent($query)
            ->editColumn('data_da_despesa', fn($despesa) => $despesa->present()->data_da_despesa)
            ->editColumn('valor', fn(Despesa $despesa) => $despesa->present()->valor)
            ->editColumn('anexo', function (Despesa $despesa) {
                $mediaItems = $despesa->getMedia('anexo');

                if ($mediaItems->isEmpty()) {
                    return 'Nenhum anexo';
                }

                $url = route('manutencao_veicular.despesas.show', [$despesa->manutencao_veicular_id, $despesa->id, 'atributo' => 'anexo']);
                return '<a href="' . $url . '" target="_blank"><i class="fas fa-download"></i> Baixar anexo</a>';
            })
            ->editColumn('action', function (Despesa $despesa) use ($usuario) {
                return view('components.tables.links-show-edit-destroy', [
                    'destroy' => $usuario->can('delete', [$despesa, $this->manutencao]) ? route('manutencao_veicular.despesas.destroy', [$this->manutencao, $despesa]) : false,
                    'callbackDestroy' => "$('#datatable-despesas').DataTable().ajax.reload(null,false);",
                ]);
            })
            ->rawColumns(['action','anexo']);
    }

    public function query(DespesaServiceInterface $service)
    {
        return $service->getTableQueryBuilder([
                'q' => request()->input('search.value'),
                'manutencao_veicular' => $this->manutencao,
            ])
            ->with('tipo')
            ->select('manutencao_veicular_despesas.*');
    }

    public function html()
    {
        $manutencaoId = $this->manutencao ? $this->manutencao->id : 0;
        return $this->builder()
            ->setTableId('datatable-despesas')
            ->columns($this->getColumns())
            ->minifiedAjax(route('manutencao_veicular.despesas.index', $manutencaoId))
            ->dom('t')
            ->orderBy([0, 'desc'])
            ->parameters([
                'paging' => false,
                'deferLoading' => false,
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('id')
                ->width(10)
                ->addClass('text-center')
                ->searchable(false),

            Column::make('data_da_despesa')
                ->title('Data')
                ->width(100)
                ->searchable(false),

            Column::make('tipo.nome')
                ->title('Despesa')
                ->searchable(false),

            Column::make('valor')
                ->title('Valor')
                ->width(100)
                ->searchable(false),

            Column::computed('anexo')
                ->title('Anexos')
                ->width(200)
                ->searchable(false),

            Column::computed('action')
                ->orderable(false)
                ->title('')
                ->addClass('text-center')
                ->width(180),
        ];
    }

    protected function filename()
    {
        return 'Despesa_' . date('YmdHis');
    }
}
