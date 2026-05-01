@php
    $hoje = now()->startOfDay();
    $rubricaExiste = isset($rubrica) && $rubrica->exists;
    $codigoEsocialAtual = trim((string) old('codigo_esocial', $rubrica->codigo_esocial ?? ''));
    $naturezaAtual = trim((string) old('natureza', $rubrica->natureza ?? ''));
    $ativoAtual = old('ativo', $rubricaExiste && (int) $rubrica->ativo === 0 ? '0' : '1') === '1';
    $inicioAtual = old('inicio_validade', optional($rubrica->inicio_validade ?? null)->format('Y-m-d'));
    $fimAtual = old('fim_validade', optional($rubrica->fim_validade ?? null)->format('Y-m-d'));
    $inicioData = filled($inicioAtual) ? \Illuminate\Support\Carbon::parse($inicioAtual)->startOfDay() : null;
    $fimData = filled($fimAtual) ? \Illuminate\Support\Carbon::parse($fimAtual)->startOfDay() : null;
    $naturezaLabel = \App\Support\Esocial\NaturezasRubrica::label($naturezaAtual);

    $combinacaoInvalida = false;

    if ($naturezaLabel === null) {
        $combinacaoInvalida = true;
    }

    if ($ativoAtual && $inicioData?->gt($hoje)) {
        $combinacaoInvalida = true;
    }

    if ($ativoAtual && $fimData?->lt($hoje)) {
        $combinacaoInvalida = true;
    }

    if (! $ativoAtual && blank($fimAtual)) {
        $combinacaoInvalida = true;
    }

    if ($fimData !== null && $inicioData !== null && $fimData->lt($inicioData)) {
        $combinacaoInvalida = true;
    }

    $tone = $combinacaoInvalida
        ? 'border-amber-400/20 bg-amber-500/10 text-amber-100'
        : 'border-cyan-400/20 bg-cyan-500/10 text-cyan-100';

    $heading = $ativoAtual ? 'Rubrica ativa na janela atual' : 'Rubrica inativa ou programada';
@endphp

<div class="rounded-3xl border px-5 py-4 {{ $tone }}">
    <p class="text-xs uppercase tracking-[0.35em]">Consistencia S-1010</p>
    <h3 class="mt-2 text-lg font-semibold">{{ $heading }}</h3>
    <ul class="mt-3 space-y-2 text-sm leading-6">
        <li>
            {{ $naturezaLabel !== null
                ? "Natureza suportada no recorte atual: {$naturezaLabel}."
                : '`natRubr` deve usar uma natureza suportada pelo recorte atual do S-1010.' }}
        </li>
        <li>
            {{ $ativoAtual
                ? 'Rubricas ativas precisam iniciar ate hoje e nao podem encerrar no passado.'
                : 'Rubricas inativas precisam informar fim de validade para preservar o encerramento da trilha.' }}
        </li>
        <li>
            {{ $codigoEsocialAtual !== ''
                ? 'A rubrica atual ja esta identificada com codigo eSocial para a parametrizacao.'
                : 'Sem codigo eSocial: a rubrica continua como pendencia de parametrizacao do S-1010.' }}
        </li>
        <li>
            {{ $combinacaoInvalida
                ? 'A combinacao atual pede ajuste antes do salvamento.'
                : 'A combinacao atual esta alinhada com as regras operacionais ja ativas no cadastro.' }}
        </li>
    </ul>
</div>
