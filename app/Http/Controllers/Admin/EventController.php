<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    use HandlesImageUploads;

    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->input('when') === 'upcoming', fn ($q) => $q->whereDate('date', '>=', today()))
            ->when($request->input('when') === 'past', fn ($q) => $q->whereDate('date', '<', today()))
            ->orderByDesc('date')
            ->paginate(20)
            ->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create', ['event' => new Event(['date' => today()])]);
    }

    public function store(Request $request)
    {
        Event::create($this->validated($request));

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validated($request, $event));

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $this->deleteUploadedImage($event->image);
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted.');
    }

    private function validated(Request $request, ?Event $event = null): array
    {
        $data = $request->validate([
            'title_en' => ['required', 'string', 'max:255'],
            'title_uz' => ['nullable', 'string', 'max:255'],
            'title_ja' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'location_en' => ['required', 'string', 'max:255'],
            'location_uz' => ['nullable', 'string', 'max:255'],
            'location_ja' => ['nullable', 'string', 'max:255'],
            'type_en' => ['required', 'string', 'max:255'],
            'type_uz' => ['nullable', 'string', 'max:255'],
            'type_ja' => ['nullable', 'string', 'max:255'],
            'image_file' => $this->imageRules(),
        ]);

        unset($data['image_file']);
        $data['image'] = $this->storeImage($request, 'image_file', 'events', $event?->image);
        $data['is_past'] = Carbon::parse($data['date'])->startOfDay()->lt(today());

        return $data;
    }
}
