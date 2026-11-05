<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    use HandlesImageUploads;

    public function index(Request $request)
    {
        $news = News::query()
            ->when($request->filled('search'), fn ($q) => $q->where('title_en', 'like', '%'.$request->input('search').'%'))
            ->orderByDesc('date')
            ->paginate(20)
            ->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create', ['news' => new News(['date' => today()])]);
    }

    public function store(Request $request)
    {
        News::create($this->validated($request));

        return redirect()->route('admin.news.index')
            ->with('success', 'News created.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $news->update($this->validated($request, $news));

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

    private function validated(Request $request, ?News $news = null): array
    {
        $request->merge(['slug' => Str::slug($request->input('slug') ?: $request->input('title_en', ''))]);

        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', Rule::unique('news', 'slug')->ignore($news)],
            'title_en' => ['required', 'string', 'max:255'],
            'title_uz' => ['nullable', 'string', 'max:255'],
            'title_ja' => ['nullable', 'string', 'max:255'],
            'type_en' => ['nullable', 'string', 'max:255'],
            'type_uz' => ['nullable', 'string', 'max:255'],
            'type_ja' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'summary_en' => ['nullable', 'string'],
            'summary_uz' => ['nullable', 'string'],
            'summary_ja' => ['nullable', 'string'],
            'body_en' => ['nullable', 'string'],
            'body_uz' => ['nullable', 'string'],
            'body_ja' => ['nullable', 'string'],
            'image_file' => $this->imageRules(),
        ]);

        unset($data['image_file']);
        $data['image'] = $this->storeImage($request, 'image_file', 'news', $news?->image);

        return $data;
    }
}
