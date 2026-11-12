<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Support\Images;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * Move every file from a multi-file input into public/uploads/{folder}
     * and return the public-relative paths, in the order they were uploaded.
     */
    protected function storeImages(Request $request, string $field, string $folder): array
    {
        $paths = [];

        foreach ($request->file($field, []) as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $name = Str::uuid().'.'.$file->extension();
            $file->move(public_path("uploads/{$folder}"), $name);
            $paths[] = "uploads/{$folder}/{$name}";
        }

        return $paths;
    }

    /**
     * Apply a gallery's "delete these, add these" request to $model->images():
     * remove the ticked images (file and row), then append newly uploaded
     * ones after whatever sort_order is already in use.
     */
    protected function syncGalleryImages(Request $request, Model $model, string $folder): void
    {
        $deleteIds = array_map('intval', (array) $request->input('delete_images', []));

        if ($deleteIds) {
            $toDelete = $model->images()->whereIn('id', $deleteIds)->get();
            foreach ($toDelete as $image) {
                $this->deleteUploadedImage($image->path);
            }
            $model->images()->whereIn('id', $deleteIds)->delete();
        }

        $newPaths = $this->storeImages($request, 'gallery_images', $folder);
        $nextOrder = (int) $model->images()->max('sort_order') + 1;

        foreach ($newPaths as $i => $path) {
            $model->images()->create(['path' => $path, 'sort_order' => $nextOrder + $i]);
        }
    }

    /** Delete every gallery file before the parent row (and its images) are removed. */
    protected function deleteGalleryImages(Model $model): void
    {
        foreach ($model->images as $image) {
            $this->deleteUploadedImage($image->path);
        }
    }
}
