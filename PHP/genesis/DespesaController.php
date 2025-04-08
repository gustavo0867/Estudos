<?php
namespace App\Http\Controllers\Veiculos\Manutencao;

use App\Http\Controllers\Controller;
use App\Models\Veiculos\Manutencao\Despesa;
use App\Models\Veiculos\Manutencao\ManutencaoVeicular;
use App\Contracts\Models\Veiculos\Manutencao\DespesaServiceInterface;
use App\Contracts\Tables\Veiculos\Manutencao\DespesaTableServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Veiculos\Manutencao\DespesaRequest;

class DespesaController extends Controller
{
    public function index(DespesaTableServiceInterface $tableService, ManutencaoVeicular $manutencao)
    {
        $this->authorize('viewAny', [Despesa::class, $manutencao]);

        return $tableService->setParams([
            'manutencao' => $manutencao,
        ])->responseAjax();
    }

    public function create(ManutencaoVeicular $manutencao)
    {
        //
    }

    public function store(
        DespesaServiceInterface $service,
        DespesaRequest $request,
        ManutencaoVeicular $manutencao
    ) {
        $this->authorize('create', [Despesa::class, $manutencao]);

        $service->create(array_merge($request->despesa, [
            'manutencao_veicular_id' => $manutencao->id,
        ]));
    }

    public function show(ManutencaoVeicular $manutencao, Despesa $despesa)
    {
        $this->authorize('view', [$despesa, $manutencao]);

        if (request()->ajax()) {
            $despesa->load('tipo');
            return response()->json($despesa);
        }

        if ($despesa->hasMedia('anexo')) {
            $anexo = $despesa->getFirstMedia('anexo');
            return response()->download($anexo->getPath(), $anexo->file_name);
        }
    }

    public function edit(ManutencaoVeicular $manutencao, Despesa $despesa)
    {
        //
    }

    public function update(
        DespesaRequest $request,
        DespesaServiceInterface $service,
        ManutencaoVeicular $manutencao,
        Despesa $despesa
    ) {
        $this->authorize('update', [$despesa, $manutencao]);

        $service->update($despesa, array_merge($request->despesa, [
            'manutencao_veicular_id' => $manutencao->id,
        ]));
    }

    public function destroy(
        DespesaServiceInterface $service,
        ManutencaoVeicular $manutencao,
        Despesa $despesa
    ) {
        $this->authorize('delete', [$despesa, $manutencao]);

        $service->destroy($despesa);
    }
}
