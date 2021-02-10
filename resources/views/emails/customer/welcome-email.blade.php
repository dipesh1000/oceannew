@component('mail::message')
Thanks for Signing up.

Please Varify your email

@component('mail::button', ['url' => $url])
Click to verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent