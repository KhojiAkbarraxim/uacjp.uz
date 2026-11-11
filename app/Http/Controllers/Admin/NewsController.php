<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use App\Support\Locales;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use HandlesImageUploads;

    public function index(Request $request)
    {
        $news = News::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%'.$request->input('search').'%';
                $q->where(function ($q) use ($term) {
                    foreach (Locales::ORDER as $locale) {
                        $q->orWhere("title_{$locale}", 'like', $term);
                    }
                });
            })
            ->orderByDesc('date')
            ->paginate(20)
            ->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create', ['news' => new News(['date' => today()])]);
    }

    public function store(NewsRequest $request)
    {
        News::create($this->payload($request));

        return redirect()->route('admin.news.index')
            ->with('success', 'News created.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $news->update($this->payload($request, $news));

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated.');
    }

    public function destroy(News $news)
    {
        $this->deleteUploadedImage($news->image);
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted.');
    }

    private function payload(NewsRequest $request, ?News $news = null): array
    {
        $data = $request->validated();

        unset($data['image_file']);
        $data['image'] = $this->storeImage($request, 'image_file', 'news', $news?->image);

        return $data;
    }
}
