<div class="space-y-4">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Identificacao do ente</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Base institucional</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'name', 'label' => 'Nome do orgao', 'required' => true, 'placeholder' => 'Prefeitura Municipal', 'value' => old('name', $tenant->name)])
        @include('servidores.partials.select', ['name' => 'tipo_inscricao', 'label' => 'Tipo de inscricao', 'required' => true, 'options' => ['1' => 'CNPJ', '2' => 'CPF'], 'value' => old('tipo_inscricao', $parametros['tipo_inscricao'] ?? '1')])
        @include('servidores.partials.field', ['name' => 'numero_inscricao', 'label' => 'Numero de inscricao', 'required' => true, 'placeholder' => '00.000.000/0001-00', 'value' => old('numero_inscricao', $parametros['numero_inscricao'] ?? null)])
        @include('servidores.partials.field', ['name' => 'natureza_juridica', 'label' => 'Natureza juridica', 'placeholder' => 'Ex.: 1244', 'value' => old('natureza_juridica', $parametros['natureza_juridica'] ?? null)])
        @include('servidores.partials.field', ['name' => 'classificacao_tributaria', 'label' => 'Classificacao tributaria', 'placeholder' => 'Ex.: 85', 'value' => old('classificacao_tributaria', $parametros['classificacao_tributaria'] ?? null)])
        @include('servidores.partials.select', ['name' => 'ambiente_esocial', 'label' => 'Ambiente eSocial', 'required' => true, 'options' => ['homologacao' => 'Homologacao', 'producao' => 'Producao'], 'value' => old('ambiente_esocial', $parametros['ambiente_esocial'] ?? 'homologacao')])
    </div>
</div>

<div class="space-y-4 border-t border-white/10 pt-6">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Validade e acompanhamento</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Janela cadastral</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'inicio_validade', 'label' => 'Inicio de validade', 'required' => true, 'placeholder' => 'AAAA-MM', 'value' => old('inicio_validade', $parametros['inicio_validade'] ?? now()->format('Y-m'))])
        @include('servidores.partials.field', ['name' => 'fim_validade', 'label' => 'Fim de validade', 'placeholder' => 'AAAA-MM', 'value' => old('fim_validade', $parametros['fim_validade'] ?? null)])
    </div>
</div>

<div class="space-y-4 border-t border-white/10 pt-6">
    <div>
        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Contato operacional</p>
        <h3 class="mt-2 text-lg font-semibold text-white">Referencia administrativa</h3>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @include('servidores.partials.field', ['name' => 'contato_nome', 'label' => 'Nome do contato', 'placeholder' => 'Responsavel pelo RH', 'value' => old('contato_nome', $parametros['contato_nome'] ?? null)])
        @include('servidores.partials.field', ['name' => 'contato_cpf', 'label' => 'CPF do contato', 'placeholder' => '000.000.000-00', 'value' => old('contato_cpf', $parametros['contato_cpf'] ?? null)])
        @include('servidores.partials.field', ['name' => 'contato_email', 'label' => 'E-mail do contato', 'type' => 'email', 'placeholder' => 'rh@prefeitura.gov.br', 'value' => old('contato_email', $parametros['contato_email'] ?? null)])
        @include('servidores.partials.field', ['name' => 'telefone', 'label' => 'Telefone', 'placeholder' => '(00) 0000-0000', 'value' => old('telefone', $parametros['telefone'] ?? null)])
    </div>

    <label class="form-control">
        <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Observacoes internas</span>
        <textarea
            name="observacoes"
            rows="4"
            @class([
                'textarea textarea-bordered border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500',
                'border-rose-400/50' => $errors->has('observacoes'),
            ])
            placeholder="Anotacoes operacionais sobre o cadastro institucional"
        >{{ old('observacoes', $parametros['observacoes'] ?? null) }}</textarea>
        @error('observacoes')
            <span class="mt-2 text-sm text-rose-300">{{ $message }}</span>
        @enderror
    </label>
</div>
