<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function home()
    {
        $regions = collect(config('uac.regions'))->take(4)->values()->all();

        return view('pages.home', [
            'pageTitle' => ui('pages.home.title'),
            'metaDescription' => ui('pages.home.meta'),
            'regions' => $regions,
            'latestNews' => config('uac.latest_news'),
            'heroStats' => config('uac.hero_stats'),
            'mission' => config('uac.mission'),
            'vision' => config('uac.vision'),
            'partners' => config('uac.partners.sponsors'),
        ]);
    }

    public function activities()
    {
        /** @var Collection $grouped */
        $grouped = collect(config('uac.activities'))->groupBy(fn (array $activity) => $activity['category']['en']);

        return view('pages.activities', [
            'pageTitle' => ui('pages.activities.title'),
            'metaDescription' => ui('pages.activities.meta'),
            'activityGroups' => $grouped,
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'pageTitle' => ui('pages.about.title'),
            'metaDescription' => ui('pages.about.meta'),
            'about' => config('uac.about'),
        ]);
    }

    public function partners()
    {
        return view('pages.partners', [
            'pageTitle' => ui('pages.partners.title'),
            'metaDescription' => ui('pages.partners.meta'),
            'partners' => config('uac.partners'),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'pageTitle' => ui('pages.contact.title'),
            'metaDescription' => ui('pages.contact.meta'),
            'contact' => config('uac.contact'),
            'faqs' => config('uac.faqs'),
        ]);
    }

    public function join()
    {
        return view('pages.join', [
            'pageTitle' => ui('pages.join.title'),
            'metaDescription' => ui('pages.join.meta'),
            'join' => config('uac.join'),
        ]);
    }
}
