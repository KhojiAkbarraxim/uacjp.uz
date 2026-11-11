<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Support\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait HandlesImageUploads
{
    /**
     * Move an uploaded image into public/uploads/{folder} and return its
     * public-relative path, or the current path when nothing was uploaded.
     */
    protected function storeImage(Request $request, string $field, string $folder, ?string $current = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $current;
        }

        $file = $request->file($field);
        $name = Str::uuid().'.'.$file->extension();
        $file->move(public_path("uploads/{$folder}"), $name);

        $this->deleteUploadedImage($current);

        return "uploads/{$folder}/{$name}";
    }

    /**
     * Only files the admin uploaded are deleted; bundled images under public/images stay.
     */
    protected function deleteUploadedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/')) {
            File::delete(public_path($path));
        }
    }

    protected function imageRules(): array
    {
        return Images::rules();
    }
}
