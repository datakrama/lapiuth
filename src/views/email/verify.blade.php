@component('mail::message')
# {{ __('E-Mail Verification') }}

{{ __('Please click the button below to verify your email address.') }}

@component('mail::button', ['url' => $url])
{{ __('Verify Email Address') }}
@endcomponent

{{ __('If you did not create an account, no further action is required.') }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
