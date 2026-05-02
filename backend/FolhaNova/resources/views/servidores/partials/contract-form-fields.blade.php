@php
    $pessoa = $servidor->pessoa;
@endphp

<input type="hidden" name="nome_completo" value="{{ old('nome_completo', $pessoa?->nome_completo) }}">
<input type="hidden" name="nome_social" value="{{ old('nome_social', $pessoa?->nome_social) }}">
<input type="hidden" name="cpf" value="{{ old('cpf', $pessoa?->cpf) }}">
<input type="hidden" name="nis" value="{{ old('nis', $pessoa?->nis) }}">
<input type="hidden" name="data_nascimento" value="{{ old('data_nascimento', optional($pessoa?->data_nascimento)->format('Y-m-d')) }}">
<input type="hidden" name="sexo" value="{{ old('sexo', $pessoa?->sexo) }}">
<input type="hidden" name="estado_civil" value="{{ old('estado_civil', $pessoa?->estado_civil) }}">
<input type="hidden" name="email" value="{{ old('email', $pessoa?->email) }}">
<input type="hidden" name="telefone" value="{{ old('telefone', $pessoa?->telefone) }}">
<input type="hidden" name="logradouro" value="{{ old('logradouro', $pessoa?->logradouro) }}">
<input type="hidden" name="numero" value="{{ old('numero', $pessoa?->numero) }}">
<input type="hidden" name="complemento" value="{{ old('complemento', $pessoa?->complemento) }}">
<input type="hidden" name="bairro" value="{{ old('bairro', $pessoa?->bairro) }}">
<input type="hidden" name="cidade" value="{{ old('cidade', $pessoa?->cidade) }}">
<input type="hidden" name="uf" value="{{ old('uf', $pessoa?->uf) }}">
<input type="hidden" name="cep" value="{{ old('cep', $pessoa?->cep) }}">

<div class="space-y-4">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Vinculo funcional</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Dados contratuais do S-2206</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'matricula', 'label' => 'Matricula', 'required' => true, 'placeholder' => '2026-0001', 'value' => old('matricula', $servidor->matricula ?? null)])
        @include('servidores.partials.select', ['name' => 'tipo_vinculo', 'label' => 'Tipo de vinculo', 'required' => true, 'options' => ['estatutario' => 'Estatutario', 'celetista' => 'Celetista', 'comissionado' => 'Comissionado', 'temporario' => 'Temporario', 'eletivo' => 'Eletivo', 'estagiario' => 'Estagiario'], 'value' => old('tipo_vinculo', $servidor->tipo_vinculo ?? null)])
        @include('servidores.partials.select', ['name' => 'categoria_esocial', 'label' => 'Categoria eSocial', 'options' => \App\Support\Esocial\CategoriasTrabalhador::options(), 'value' => old('categoria_esocial', $servidor->categoria_esocial ?? null)])
        @include('servidores.partials.select', ['name' => 'regime_previdenciario', 'label' => 'Regime previdenciario', 'options' => ['rpps' => 'RPPS', 'rgps' => 'RGPS', 'outro' => 'Outro'], 'value' => old('regime_previdenciario', $servidor->regime_previdenciario ?? null)])
        @include('servidores.partials.select-model', ['name' => 'lotacao_id', 'label' => 'Lotacao', 'items' => $lotacoes, 'value' => old('lotacao_id', $servidor->lotacao_id ?? null)])
        @include('servidores.partials.select-model', ['name' => 'cargo_id', 'label' => 'Cargo', 'items' => $cargos, 'value' => old('cargo_id', $servidor->cargo_id ?? null)])
        @include('servidores.partials.select-model', ['name' => 'funcao_id', 'label' => 'Funcao', 'items' => $funcoes, 'value' => old('funcao_id', $servidor->funcao_id ?? null)])
        @include('servidores.partials.field', ['name' => 'data_admissao', 'label' => 'Data de admissao', 'type' => 'date', 'required' => true, 'value' => old('data_admissao', optional($servidor->data_admissao ?? null)->format('Y-m-d'))])
        @include('servidores.partials.field', ['name' => 'salario_base', 'label' => 'Salario base', 'required' => true, 'type' => 'number', 'step' => '0.01', 'min' => '0', 'value' => old('salario_base', $servidor->salario_base ?? null)])
        @include('servidores.partials.select', ['name' => 'situacao', 'label' => 'Situacao', 'required' => true, 'options' => ['ativo' => 'Ativo', 'afastado' => 'Afastado', 'desligado' => 'Desligado'], 'value' => old('situacao', $servidor->situacao ?? 'ativo')])
    </div>
</div>
