<div class="grid gap-4 md:grid-cols-2">
    @include('lotacoes.partials.field', ['name' => 'codigo', 'label' => 'Codigo interno', 'required' => true, 'placeholder' => 'EDU-001', 'value' => old('codigo', $lotacao->codigo ?? null)])
    @include('lotacoes.partials.field', ['name' => 'nome', 'label' => 'Nome da lotacao', 'required' => true, 'placeholder' => 'Secretaria de Educacao', 'value' => old('nome', $lotacao->nome ?? null)])
    @include('lotacoes.partials.select', ['name' => 'tipo', 'label' => 'Tipo', 'required' => true, 'options' => \App\Support\Esocial\TiposLotacao::options(), 'value' => old('tipo', $lotacao->tipo ?? 'setor')])
    @include('lotacoes.partials.field', ['name' => 'codigo_esocial', 'label' => 'Codigo eSocial', 'placeholder' => 'S1005-EDU', 'value' => old('codigo_esocial', $lotacao->codigo_esocial ?? null)])
    @include('lotacoes.partials.select', ['name' => 'ativa', 'label' => 'Situacao', 'required' => true, 'options' => ['1' => 'Ativa', '0' => 'Inativa'], 'value' => old('ativa', isset($lotacao) ? ((int) $lotacao->ativa === 1 ? '1' : '0') : '1')])
</div>
