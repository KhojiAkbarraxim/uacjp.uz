<?php

namespace App\Http\Controllers;

use App\Support\Content;

class RegionController extends Controller
{
    public function index()
    {
        return view('pages.regions.index', [
            'pageTitle' => ui('pages.regions_index.title'),
            'metaDescription' => ui('pages.regions_index.meta'),
            'regions' => array_values(Content::regions()),
        ]);
    }

    public function show(string $slug)
    {
        $region = Content::region($slug);

        abort_unless($region, 404);

        $metaTemplate = ui('pages.regions_show.meta_template');
        $metaDescription = collect($metaTemplate)
            ->mapWithKeys(fn (string $template, string $locale) => [$locale => sprintf($template, $region['name'][$locale])])
            ->all();

        return view('pages.regions.show', [
            'pageTitle' => $region['name'],
            'metaDescription' => $metaDescription,
            'region' => $region,
        ]);
    }
}
