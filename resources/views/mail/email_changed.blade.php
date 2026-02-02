<x-mail::message>
# {{ __('mail.greet', ['name' => $name]) }}

{!! __('mail.user.email_changed.line_1') !!}

<br>

{!! __('mail.salutation') !!}
</x-mail::message>
