@component('mail::message')
# New UAC Japan Membership Application

A new membership application has been submitted.

**Name:** {{ $application->name }}  
**Email:** {{ $application->email }}  
**Membership Type:** {{ $application->membership_type }}  
**Region:** {{ $application->region }}  
@if ($application->affiliation)
**Affiliation:** {{ $application->affiliation }}  
@endif
@if ($application->message)
**Message:**  
{{ $application->message }}  
@endif

Submitted at: {{ $application->created_at->format('Y-m-d H:i:s') }}

{{ config('app.name', 'UAC Japan') }}

@endcomponent
