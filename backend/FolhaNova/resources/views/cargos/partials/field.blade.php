@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'value' => null,
])

<label class="form-control">
    <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">{{ $label }}@if ($required) * @endif</span>
    @if ($type === 'textarea')
        <textarea
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @required($required)
            @class([
                'textarea textarea-bordered min-h-32 border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500',
                'border-rose-400/50' => $errors->has($name),
            ])
        >{{ $value }}</textarea>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            @required($required)
            @class([
                'input input-bordered border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500',
                'border-rose-400/50' => $errors->has($name),
            ])
        >
    @endif
    @error($name)
        <span class="mt-2 text-sm text-rose-300">{{ $message }}</span>
    @enderror
</label>
