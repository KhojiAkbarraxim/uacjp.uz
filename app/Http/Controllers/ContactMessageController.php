<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Support\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $contact = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            // The topic <select> carries translated labels as its values, so it
            // is validated as free text rather than against a fixed list.
            'topic' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        try {
            Mail::to(Content::contactEmail())->send(new ContactMessageReceived($contact));
        } catch (Throwable $e) {
            Log::error('Contact message could not be sent: '.$e->getMessage());

            return back()
                ->withInput()
                ->with('error', i18n_text(ui('pages.contact.send_failed')));
        }

        return back()->with('success', i18n_text(ui('pages.contact.send_success')));
    }
}
