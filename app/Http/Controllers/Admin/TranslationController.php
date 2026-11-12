<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Translator;
use App\Support\Locales;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TranslationController extends Controller
{
    public function __invoke(Request $request, Translator $translator): JsonResponse
    {
        if (! Translator::configured()) {
            return response()->json(['message' => 'Translation is not configured on this server.'], 503);
        }

        // Validated by hand: the app only renders JSON errors for api/* routes.
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string', 'max:10000'],
            'to' => ['required', 'array', 'min:1'],
            'to.*' => ['string', Rule::in(array_diff(Locales::ORDER, [Locales::SOURCE]))],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        try {
            $translations = $translator->translate($data['text'], Locales::SOURCE, array_values(array_unique($data['to'])));
        } catch (RequestException|ConnectionException $e) {
            Log::warning('Azure translation failed: '.$e->getMessage());

            return response()->json(['message' => 'The translation service did not respond. Try again later.'], 502);
        }

        return response()->json(['translations' => $translations]);
    }
}
