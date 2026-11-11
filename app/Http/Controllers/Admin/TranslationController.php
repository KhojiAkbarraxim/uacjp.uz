<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TranslateRequest;
use App\Services\Translator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class TranslationController extends Controller
{
    public function __invoke(TranslateRequest $request, Translator $translator): JsonResponse
    {
        if (blank(config('services.anthropic.key'))) {
            return response()->json(['message' => 'Translation is not configured on this site.'], 503);
        }

        try {
            $translations = $translator->translate($request->fields(), $request->input('context') ?: 'website content');
        } catch (Throwable $e) {
            Log::error('Translation failed: '.$e->getMessage());

            // The admin keeps whatever they typed; only the empty boxes were
            // going to be filled, so there is nothing to roll back.
            return response()->json(['message' => 'Translation failed. Please try again or write it by hand.'], 502);
        }

        return response()->json(['translations' => $translations]);
    }
}
