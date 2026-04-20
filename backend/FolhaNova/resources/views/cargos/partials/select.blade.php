@props([
    'name',
    'label',
    'options' => [],
    'required' => false,
    'value' => null,
])

<label class="form-control">
    <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">{{ $label }}@if ($required) * @endif</span>
    <select
        name="{{ $name }}"
        @required($required)
        @class([
            'select select-bordered border-white/10 bg-slate-950/50 text-sm text-white',
            'border-rose-400/50' => $errors->has($name),
        ])
    >
        <option value="">Selecione</option>
        @foreach ($options as $optionValue => $text)
            <option value="{{ $optionValue }}" @selected((string) $optionValue === (string) $value)>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="mt-2 text-sm text-rose-300">{{ $message }}</span>
    @enderror
</label>
