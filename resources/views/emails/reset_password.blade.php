@component('mail::message')
    # Reset Password

    Welcome, {{ $data->name }}

    Pin Code To Reset Password Is : {{ $data->pin_code }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
