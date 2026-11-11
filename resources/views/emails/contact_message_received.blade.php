@component('mail::message')
# New message from the contact form

**Name:** {{ $contact['name'] }}
**Email:** {{ $contact['email'] }}
@if (! empty($contact['topic']))
**Topic:** {{ $contact['topic'] }}
@endif

**Message:**

{{ $contact['message'] }}

{{ config('app.name', 'UAC Japan') }}
@endcomponent
