@component('mail::message')
# Password Reset

Click the button below to reset your password

@component('mail::button', ['url' => route('password.reset', ['email' => $email, 'token' => $token])])
Reset password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
