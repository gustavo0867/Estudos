<x-modal id="modal-despesas" size="xl">
    <x-slot name="title">
        <x-icon>edit</x-icon> <span id="titulo">Despesas</span>
    </x-slot>

    <x-async-form id="form-de-despesas" :mostrar-titulo="false" :mostrar-footer="false">
        @include('manutencao_veicular.despesas.form')
    </x-async-form>

    <h4>Despesas</h4>
    <hr style="margin:0px">

    <x-datatable id="datatable-despesas" service="App\Contracts\Tables\ManutencaoVeicular\DespesaTableServiceInterface" :params="['manutencao_veicular' => 0]">
    </x-datatable>
</x-modal>



@push('scripts')
<script type="application/javascript">
    $(function () {
        let tabelaDeManutencao = $('#datatable');

        // Gerenciar despesas
        $('body').on('click', '[data-action="mostrar-despesas"]', function (e) {
            e.preventDefault();

            let url = $(this).attr('data-href') + '?view=content';
            let modal = $('#modal-despesas');
            let manutencaoId = $(this).attr('data-manutencao-id');
            let form = $('#form-de-despesas');
            let tabelaDeDespesas = modal.find('#datatable-despesas');

            // Atualiza título
            modal.find('span#titulo').html('Despesas da manutenção #' + manutencaoId);

            // Define nova URL da tabela
            tabelaDeDespesas.DataTable().ajax.url('/manutencao_veicular/' + manutencaoId + '/despesas');

            // Recarrega e inicia o form
            tabelaDeDespesas.DataTable().ajax.reload(function () {
                iniciarFormularioDeDespesa(form, {
                    formData: true,
                    action: '/manutencao_veicular/' + manutencaoId + '/despesas',
                    titulo: 'Lançar despesa',
                    method: 'POST',
                    concluido: function () {
                        tabelaDeDespesas.DataTable().ajax.reload();
                        tabelaDeManutencao.DataTable().ajax.reload(null, false);
                    },
                    reset: function () { }
                });

                $('[data-btn-modal="modal-despesas"]').click();
            });
        });
    });
</script>
@endpush
