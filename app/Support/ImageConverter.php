<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

/**
 * Converts an admin-uploaded JPG/PNG/WebP to WebP before it is stored, so
 * every upload lands in one format that is both smaller on disk and loads
 * faster on the public site. Requires the GD extension with WebP support
 * (confirmed present on the hosting account's PHP 8.4 build); where GD or
 * WebP output is unavailable - a local dev machine without php-gd - the
 * caller keeps the file in whatever format it was uploaded in instead.
 */
class ImageConverter
{
    private const QUALITY = 82;

    public static function available(): bool
    {
        return extension_loaded('gd') && function_exists('imagewebp') && (imagetypes() & IMG_WEBP);
    }

    /**
     * Converts $file to WebP and writes it to $destinationDir/$filenameWithoutExtension.webp.
     * Returns the written filename (with its .webp extension) on success, or
     * null if the source couldn't be decoded - the caller falls back to
     * storing the original file unchanged.
     */
    public static function convert(UploadedFile $file, string $destinationDir, string $filenameWithoutExtension): ?string
    {
        $image = self::load($file);

        if ($image === null) {
            return null;
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, false);
        imagesavealpha($image, true);

        $filename = "{$filenameWithoutExtension}.webp";

        if (! is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        $saved = imagewebp($image, "{$destinationDir}/{$filename}", self::QUALITY);
        imagedestroy($image);

        if (! $saved) {
            Log::warning("ImageConverter: imagewebp() failed for {$file->getClientOriginalName()}");

            return null;
        }

        return $filename;
    }

    /** @return \GdImage|null */
    private static function load(UploadedFile $file)
    {
        $path = $file->getRealPath();

        try {
            return match ($file->getMimeType()) {
                'image/png' => imagecreatefrompng($path) ?: null,
                'image/webp' => imagecreatefromwebp($path) ?: null,
                'image/gif' => imagecreatefromgif($path) ?: null,
                'image/jpeg' => imagecreatefromjpeg($path) ?: null,
                default => null,
            };
        } catch (\Throwable $e) {
            Log::warning("ImageConverter: could not decode {$file->getClientOriginalName()}: ".$e->getMessage());

            return null;
        }
    }
}
