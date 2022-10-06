@component('mail::message')
# Email verification

Click the button below to verify your email address

@component('mail::button', ['url' => route('email.verify', ['email' => $email, 'token' => $token] )])
Verify email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
