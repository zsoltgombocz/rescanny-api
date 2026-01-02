<x-mail::message>
# {{ __('mail.greet', ['name' => $name]) }}

{!! __('mail.user.deleted.line_1') !!}

@if($deletedByAdmin)
{!! __('mail.user.deleted.line_admin') !!}
@endif

<br>

{!! __('mail.user.deleted.line_2') !!}

{!! __('mail.salutation') !!}
</x-mail::message>
