@component('mail::message')
# {{ __('Reset Password') }}

{{ __('You are receiving this email because we received a password reset request for your account.') }}

@component('mail::button', ['url' => $url . '/password/reset/' . $token])
{{ __('Reset Password') }}
@endcomponent

This password reset link will expire in {{ $count }} minutes.

{{ __('If you did not request a password reset, no further action is required.') }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
