<?php

namespace App\Http\Controllers;

use App\Support\Content;

class NewsController extends Controller
{
    public function show(string $slug)
    {
        $news = Content::newsItem($slug);

        abort_unless($news, 404);

        return view('pages.news.show', [
            'pageTitle' => $news['title'],
            'metaDescription' => $news['summary'],
            'news' => $news,
        ]);
    }
}
