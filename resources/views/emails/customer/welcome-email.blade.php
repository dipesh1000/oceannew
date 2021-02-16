@component('mail::message')
Thanks for Signing up.

Please Varify your email

@component('mail::button', ['url' => $url . $data['id'].'/'.$code])
Click to verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent