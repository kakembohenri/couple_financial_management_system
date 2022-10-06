@component('mail::message')
# Invitation

You have been invited by {{ $sender_email }} to join this system.
Click on the button below to accept the invitation.

@component('mail::button', ['url' => route('accept.invite', ['sender' => $sender_email, 'reciever' => $reciever_email])])
Accept invitation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
