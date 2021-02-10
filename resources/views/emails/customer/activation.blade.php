<h1>Hello</h1>
<p>please activate
    <a href="{{ env('APP_URL') }}/user/activate/{{ $user->id }}/{{ $activation->code }}">Activate account</a>
</p>
