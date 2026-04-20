<div class="grid gap-4 md:grid-cols-2">
    @include('funcoes.partials.field', ['name' => 'codigo', 'label' => 'Codigo interno', 'required' => true, 'placeholder' => 'FUN-001', 'value' => old('codigo', $funcao->codigo ?? null)])
    @include('funcoes.partials.field', ['name' => 'nome', 'label' => 'Nome da funcao', 'required' => true, 'placeholder' => 'Coordenador Pedagogico', 'value' => old('nome', $funcao->nome ?? null)])
    @include('funcoes.partials.field', ['name' => 'codigo_esocial', 'label' => 'Codigo eSocial', 'placeholder' => 'S1040-COORD', 'value' => old('codigo_esocial', $funcao->codigo_esocial ?? null)])
    @include('funcoes.partials.select', ['name' => 'ativo', 'label' => 'Situacao', 'required' => true, 'options' => ['1' => 'Ativa', '0' => 'Inativa'], 'value' => old('ativo', isset($funcao) ? ((int) $funcao->ativo === 1 ? '1' : '0') : '1')])
    <div class="md:col-span-2">
        @include('funcoes.partials.field', ['name' => 'descricao', 'label' => 'Descricao', 'type' => 'textarea', 'placeholder' => 'Descreva o papel e a responsabilidade da funcao', 'value' => old('descricao', $funcao->descricao ?? null)])
    </div>
</div>
