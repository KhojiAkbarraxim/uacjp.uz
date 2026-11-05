@props(['name', 'label', 'current' => null])

<div>
    <label class="admin-label" for="{{ $name }}_file">{{ $label }}</label>
    <div class="flex items-center gap-4">
        @if ($current)
            <img src="{{ asset($current) }}" alt="" class="h-16 w-24 rounded-lg border border-line object-cover">
        @endif
        <input id="{{ $name }}_file" name="{{ $name }}_file" type="file" accept="image/jpeg,image/png,image/webp" class="form-input">
    </div>
    <p class="admin-hint">JPG, PNG or WebP, up to 4 MB. @if ($current) Leave empty to keep the current image. @endif</p>
</div>
