@inject('tipoDespesa', 'App\Contracts\Models\Veiculos\Manutencao\TipoDeDespesaServiceInterface')

<x-row>
    <x-col size="6,sm-6,md-6,lg-2">
        <x-form-group>
            <x-row>
                <x-label size="12" for="data_da_despesa" required>Data</x-label>
                <x-col size="12">
                    <x-input id="data_da_despesa"
                             :data-mask-datepicker="true"
                             name="despesa[data_da_despesa]"
                             value=""
                             required />
                </x-col>
            </x-row>
        </x-form-group>
    </x-col>

    <x-col size="12,sm-12,md-6,lg-3">
        <x-form-group>
            <x-row>
                <x-label size="12" for="tipo_id" required>Despesa</x-label>
                <x-col size="12">
                    <x-select id="tipo_id" name="despesa[tipo_id]" required>
                        <option value=""></option>
                        @foreach($tipoDespesa->all()->sortBy('nome') as $tipo)
                            <option data-exige-km="{{ $tipo->exige_km }}" value="{{ $tipo->id }}">
                                {{ $tipo->nome }}
                            </option>
                        @endforeach
                    </x-select>
                </x-col>
            </x-row>
        </x-form-group>
    </x-col>

    <x-col size="6,sm-6,md-6,lg-2">
        <x-form-group>
            <x-row>
                <x-label size="12" for="valor" required>Valor</x-label>
                <x-col size="12">
                    <x-input id="valor"
                             name="despesa[valor]"
                             value=""
                             required />
                </x-col>
            </x-row>
        </x-form-group>
    </x-col>

    <x-col size="12,sm-12,md-10,lg-4">
        <x-form-group>
            <x-row class="align-items-center">
                <x-col size="12">
                    <x-label for="anexos">
                        <x-icon>cliper</x-icon> Anexos
                    </x-label>
                </x-col>
                <x-col size="12">
                    <input type="file" name="despesa[anexo]" id="anexo" value="" :multiple="false" />
                </x-col>
            </x-row>
        </x-form-group>
    </x-col>

    <x-col size="7,sm-7,md-7,lg-1">
        <x-row>
            <x-label size="12" for="salvar">&nbsp;</x-label>
            <x-col size="12">
                <x-button :submit="true" type="primary" size="block">
                    <x-icon>save</x-icon><span class="">Salvar</span>
                </x-button>
            </x-col>
        </x-row>
    </x-col>
</x-row>

@push('scripts')
<script type="application/javascript">
    function iniciarFormularioDeDespesa(form, opcoes) {
        form.trigger('init', opcoes);

        if (opcoes.dados) {
            let item = opcoes.dados;
            form.find('#tipo_id').val(item.tipo_id).change();
            form.find('#data_da_despesa').val(item.data_da_despesa);
            form.find('#valor').val(formatarDinheiro(item.valor));
            form.find('#anexo').val(item.anexo);
        }
    }
</script>
@endpush
