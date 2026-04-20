<div class="grid gap-4 md:grid-cols-2">
    @include('cargos.partials.field', ['name' => 'codigo', 'label' => 'Codigo interno', 'required' => true, 'placeholder' => 'CARGO-001', 'value' => old('codigo', $cargo->codigo ?? null)])
    @include('cargos.partials.field', ['name' => 'nome', 'label' => 'Nome do cargo', 'required' => true, 'placeholder' => 'Professor Municipal', 'value' => old('nome', $cargo->nome ?? null)])
    @include('cargos.partials.field', ['name' => 'codigo_esocial', 'label' => 'Codigo eSocial', 'placeholder' => 'S1030-PROF', 'value' => old('codigo_esocial', $cargo->codigo_esocial ?? null)])
    @include('cargos.partials.select', ['name' => 'ativo', 'label' => 'Situacao', 'required' => true, 'options' => ['1' => 'Ativo', '0' => 'Inativo'], 'value' => old('ativo', isset($cargo) ? ((int) $cargo->ativo === 1 ? '1' : '0') : '1')])
    <div class="md:col-span-2">
        @include('cargos.partials.field', ['name' => 'descricao', 'label' => 'Descricao', 'type' => 'textarea', 'placeholder' => 'Descreva o escopo e o papel do cargo', 'value' => old('descricao', $cargo->descricao ?? null)])
    </div>
</div>
