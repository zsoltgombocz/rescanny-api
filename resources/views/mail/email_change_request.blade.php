<x-mail::message>
# {{ __('mail.greet', ['name' => $name]) }}

{!! __('mail.user.email_change.line_1') !!}

<div style="text-align: center">
    <blockquote>{{ $code }}</blockquote>
</div>

{!! __('mail.email_change.warning') !!}

<br>

{!! __('mail.salutation') !!}
</x-mail::message>
