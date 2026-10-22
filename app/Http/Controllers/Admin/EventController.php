<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'is_past' => ['nullable', 'boolean'],
            'image' => ['nullable', 'string'],
        ]);

        $validated['is_past'] = $request->has('is_past');
        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
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
            'is_past' => ['nullable', 'boolean'],
        ]);

        $validated['is_past'] = $request->has('is_past');
        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted.');
    }
}
