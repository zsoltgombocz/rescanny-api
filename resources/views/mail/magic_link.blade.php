<x-mail::message>
# {{ __('mail.greet', ['name' => $name]) }}

{!! __('mail.auth.magic_link.line_1') !!}
{!! __('mail.auth.magic_link.line_2') !!}

<x-mail::button :url="$link">{{ __('mail.auth.magic_link.button') }}</x-mail::button>

{!! __('mail.auth.warning') !!}

<br>

{!! __('mail.button.problem', ['url' => $link]) !!}

{!! __('mail.salutation') !!}
</x-mail::message>
