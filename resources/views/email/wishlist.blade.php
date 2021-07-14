@component('mail::message')
# New Listing

{{ $game }} has a new Listing!

@component('mail::button', ['url' => $url])
View Listing
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent