@props(['images' => []])

<div>
    <p class="admin-label">Gallery (optional)</p>
    @if (count($images))
        <div class="mb-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ($images as $image)
                <div class="overflow-hidden rounded-lg border border-line">
                    <img src="{{ asset($image->path) }}" alt="" class="h-20 w-full object-cover">
                    <label class="flex items-center gap-2 bg-surface-strong px-2 py-1.5 text-xs text-primary">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                        Remove
                    </label>
                </div>
            @endforeach
        </div>
    @endif
    <input name="gallery_images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple class="form-input">
    <p class="admin-hint">
        JPG, PNG or WebP, up to 4 MB each. 3–7 images recommended, 7 at most in total.
        @if (count($images)) Tick an image above to remove it when you save. @endif
    </p>
</div>
