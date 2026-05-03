@props([
    'name',
    'label',
    'items' => collect(),
    'value' => null,
])

<label class="form-control">
    <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">{{ $label }}</span>
    <select
        name="{{ $name }}"
        @class([
            'select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white',
            'border-rose-400/50' => $errors->has($name),
        ])
    >
        <option value="">Nao informado</option>
        @foreach ($items as $item)
            <option value="{{ $item->id }}" @selected((string) $value === (string) $item->id)>{{ $item->nome }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="mt-2 text-sm text-rose-300">{{ $message }}</span>
    @enderror
</label>
