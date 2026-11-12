<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Translator;
use App\Support\Locales;
use App\Support\UzbekLatin;
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
        // Validated by hand: the app only renders JSON errors for api/* routes.
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string', 'max:10000'],
            'to' => ['sometimes', 'array'],
            'to.*' => ['string', Rule::in(array_diff(Locales::ORDER, [Locales::SOURCE]))],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $to = array_values(array_unique($data['to'] ?? []));

        if ($to && ! Translator::configured()) {
            return response()->json(['message' => 'Translation is not configured on this server.'], 503);
        }

        // Rewriting the source itself in the new alphabet is free local text
        // processing - no Azure call, so it runs even without a target locale
        // or a configured key.
        $translations = Locales::SOURCE === 'uz'
            ? [Locales::SOURCE => UzbekLatin::toDisplay($data['text'])]
            : [];

        if ($to) {
            try {
                $translations += $translator->translate($data['text'], Locales::SOURCE, $to);
            } catch (RequestException|ConnectionException $e) {
                Log::warning('Azure translation failed: '.$e->getMessage());

                return response()->json(['message' => 'The translation service did not respond. Try again later.'], 502);
            }
        }

        return response()->json(['translations' => $translations]);
    }
}
