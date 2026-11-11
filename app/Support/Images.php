<?php

namespace App\Support;

class Images
{
    /** One definition shared by the form requests and the upload trait. */
    public static function rules(): array
    {
        return ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
    }
}
