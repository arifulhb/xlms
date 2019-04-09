@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!') {{ $name}}<br/>
<p>{{ env('APP_NAME')}} admin has created an account for your in {{ env('APP_NAME')}} application.</p><br/>
<p>Here is some basic information about your that has been added in your profile.<br/>
    <p>
    <span>ID/Bath No: {{ $batch_no }}</span> <br/>
    @if($role !== 'Teacher')
    <span>Department: {{ $department }}</span> <br/>
    <span>Role: {{ $jobrole }}</span> <br/>
    @elseif($role == 'Teacher')
    <span>Experties: {{ $expertise }}</span> <br/>
    @endif
    </p>
</p>
<p>Please follow the <strong>Set Password</strong> button link to set your password for the account.</p>

@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
