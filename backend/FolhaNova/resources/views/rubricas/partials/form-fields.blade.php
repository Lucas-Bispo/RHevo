<div class="grid gap-4 md:grid-cols-2">
    @include('cargos.partials.field', ['name' => 'codigo', 'label' => 'Codigo interno', 'required' => true, 'placeholder' => 'RUB-001', 'value' => old('codigo', $rubrica->codigo ?? null)])
    @include('cargos.partials.field', ['name' => 'nome', 'label' => 'Nome da rubrica', 'required' => true, 'placeholder' => 'Gratificacao de funcao', 'value' => old('nome', $rubrica->nome ?? null)])
    @include('cargos.partials.field', ['name' => 'natureza', 'label' => 'Natureza eSocial (natRubr)', 'required' => true, 'placeholder' => '1000', 'value' => old('natureza', $rubrica->natureza ?? null)])
    @include('cargos.partials.select', ['name' => 'tipo', 'label' => 'Tipo de rubrica', 'required' => true, 'options' => ['provento' => 'Provento', 'desconto' => 'Desconto', 'informativa' => 'Informativa'], 'value' => old('tipo', $rubrica->tipo ?? null)])
    @include('cargos.partials.field', ['name' => 'codigo_esocial', 'label' => 'Codigo eSocial', 'placeholder' => 'S1010-GRAT', 'value' => old('codigo_esocial', $rubrica->codigo_esocial ?? null)])
    @include('cargos.partials.field', ['name' => 'inicio_validade', 'label' => 'Inicio da validade', 'type' => 'date', 'required' => true, 'value' => old('inicio_validade', optional($rubrica->inicio_validade)->format('Y-m-d'))])
    @include('cargos.partials.field', ['name' => 'fim_validade', 'label' => 'Fim da validade', 'type' => 'date', 'value' => old('fim_validade', optional($rubrica->fim_validade)->format('Y-m-d'))])
    @include('cargos.partials.select', ['name' => 'ativo', 'label' => 'Situacao', 'required' => true, 'options' => ['1' => 'Ativa', '0' => 'Inativa'], 'value' => old('ativo', isset($rubrica) ? ((int) $rubrica->ativo === 1 ? '1' : '0') : '1')])
    @include('cargos.partials.select', ['name' => 'incide_irrf', 'label' => 'Incide IRRF', 'required' => true, 'options' => ['1' => 'Sim', '0' => 'Nao'], 'value' => old('incide_irrf', isset($rubrica) ? ((int) $rubrica->incide_irrf === 1 ? '1' : '0') : '0')])
    @include('cargos.partials.select', ['name' => 'incide_inss', 'label' => 'Incide INSS', 'required' => true, 'options' => ['1' => 'Sim', '0' => 'Nao'], 'value' => old('incide_inss', isset($rubrica) ? ((int) $rubrica->incide_inss === 1 ? '1' : '0') : '0')])
    @include('cargos.partials.select', ['name' => 'incide_fgts', 'label' => 'Incide FGTS', 'required' => true, 'options' => ['1' => 'Sim', '0' => 'Nao'], 'value' => old('incide_fgts', isset($rubrica) ? ((int) $rubrica->incide_fgts === 1 ? '1' : '0') : '0')])
</div>
