@php
    $pessoa = $servidor->pessoa ?? null;
@endphp

<div class="space-y-4">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Dados pessoais</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Identificacao do trabalhador</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'nome_completo', 'label' => 'Nome completo', 'required' => true, 'placeholder' => 'Nome civil do servidor', 'value' => old('nome_completo', $pessoa?->nome_completo)])
        @include('servidores.partials.field', ['name' => 'nome_social', 'label' => 'Nome social', 'placeholder' => 'Opcional', 'value' => old('nome_social', $pessoa?->nome_social)])
        @include('servidores.partials.field', ['name' => 'cpf', 'label' => 'CPF', 'required' => true, 'placeholder' => '000.000.000-00', 'value' => old('cpf', $pessoa?->cpf)])
        @include('servidores.partials.field', ['name' => 'nis', 'label' => 'NIS', 'placeholder' => 'Opcional', 'value' => old('nis', $pessoa?->nis)])
        @include('servidores.partials.field', ['name' => 'data_nascimento', 'label' => 'Data de nascimento', 'type' => 'date', 'value' => old('data_nascimento', optional($pessoa?->data_nascimento)->format('Y-m-d'))])
        @include('servidores.partials.select', ['name' => 'sexo', 'label' => 'Sexo', 'options' => ['feminino' => 'Feminino', 'masculino' => 'Masculino', 'nao_informado' => 'Nao informado'], 'value' => old('sexo', $pessoa?->sexo)])
        @include('servidores.partials.select', ['name' => 'estado_civil', 'label' => 'Estado civil', 'options' => ['solteiro' => 'Solteiro', 'casado' => 'Casado', 'divorciado' => 'Divorciado', 'viuvo' => 'Viuvo', 'uniao_estavel' => 'Uniao estavel'], 'value' => old('estado_civil', $pessoa?->estado_civil)])
        @include('servidores.partials.field', ['name' => 'email', 'label' => 'E-mail', 'type' => 'email', 'placeholder' => 'servidor@prefeitura.gov.br', 'value' => old('email', $pessoa?->email)])
        @include('servidores.partials.field', ['name' => 'telefone', 'label' => 'Telefone', 'placeholder' => '(00) 00000-0000', 'value' => old('telefone', $pessoa?->telefone)])
    </div>
</div>

<div class="space-y-4 border-t border-white/10 pt-6">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Endereco</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Base cadastral do trabalhador</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'logradouro', 'label' => 'Logradouro', 'value' => old('logradouro', $pessoa?->logradouro)])
        @include('servidores.partials.field', ['name' => 'numero', 'label' => 'Numero', 'value' => old('numero', $pessoa?->numero)])
        @include('servidores.partials.field', ['name' => 'complemento', 'label' => 'Complemento', 'value' => old('complemento', $pessoa?->complemento)])
        @include('servidores.partials.field', ['name' => 'bairro', 'label' => 'Bairro', 'value' => old('bairro', $pessoa?->bairro)])
        @include('servidores.partials.field', ['name' => 'cidade', 'label' => 'Cidade', 'value' => old('cidade', $pessoa?->cidade)])
        @include('servidores.partials.field', ['name' => 'uf', 'label' => 'UF', 'maxlength' => 2, 'placeholder' => 'SP', 'value' => old('uf', $pessoa?->uf)])
        @include('servidores.partials.field', ['name' => 'cep', 'label' => 'CEP', 'placeholder' => '00000-000', 'value' => old('cep', $pessoa?->cep)])
    </div>
</div>

<div class="space-y-4 border-t border-white/10 pt-6">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Vinculo funcional</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Dados da admissao</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'matricula', 'label' => 'Matricula', 'required' => true, 'placeholder' => '2026-0001', 'value' => old('matricula', $servidor->matricula ?? null)])
        @include('servidores.partials.select', ['name' => 'tipo_vinculo', 'label' => 'Tipo de vinculo', 'required' => true, 'options' => ['estatutario' => 'Estatutario', 'celetista' => 'Celetista', 'comissionado' => 'Comissionado', 'temporario' => 'Temporario', 'eletivo' => 'Eletivo', 'estagiario' => 'Estagiario'], 'value' => old('tipo_vinculo', $servidor->tipo_vinculo ?? null)])
        @include('servidores.partials.field', ['name' => 'categoria_esocial', 'label' => 'Categoria eSocial', 'placeholder' => 'Ex.: 301', 'value' => old('categoria_esocial', $servidor->categoria_esocial ?? null)])
        @include('servidores.partials.select', ['name' => 'regime_previdenciario', 'label' => 'Regime previdenciario', 'options' => ['rpps' => 'RPPS', 'rgps' => 'RGPS', 'outro' => 'Outro'], 'value' => old('regime_previdenciario', $servidor->regime_previdenciario ?? null)])
        @include('servidores.partials.select-model', ['name' => 'lotacao_id', 'label' => 'Lotacao', 'items' => $lotacoes, 'value' => old('lotacao_id', $servidor->lotacao_id ?? null)])
        @include('servidores.partials.select-model', ['name' => 'cargo_id', 'label' => 'Cargo', 'items' => $cargos, 'value' => old('cargo_id', $servidor->cargo_id ?? null)])
        @include('servidores.partials.select-model', ['name' => 'funcao_id', 'label' => 'Funcao', 'items' => $funcoes, 'value' => old('funcao_id', $servidor->funcao_id ?? null)])
        @include('servidores.partials.field', ['name' => 'data_admissao', 'label' => 'Data de admissao', 'type' => 'date', 'required' => true, 'value' => old('data_admissao', optional($servidor->data_admissao ?? null)->format('Y-m-d'))])
        @include('servidores.partials.field', ['name' => 'salario_base', 'label' => 'Salario base', 'required' => true, 'type' => 'number', 'step' => '0.01', 'min' => '0', 'value' => old('salario_base', $servidor->salario_base ?? null)])
        @include('servidores.partials.select', ['name' => 'situacao', 'label' => 'Situacao inicial', 'required' => true, 'options' => ['ativo' => 'Ativo', 'afastado' => 'Afastado', 'desligado' => 'Desligado'], 'value' => old('situacao', $servidor->situacao ?? 'ativo')])
        @if ($mode === 'create')
            @include('servidores.partials.select', ['name' => 'ambiente_esocial', 'label' => 'Ambiente eSocial', 'required' => true, 'options' => ['homologacao' => 'Homologacao', 'producao' => 'Producao'], 'value' => old('ambiente_esocial', 'homologacao')])
        @endif
    </div>
</div>
