@if (session()->has('account_message'))
    <div class="alert alert-{{ session()->has('account_status') && session()->get('account_status') ? 'success' : 'info' }}">
        {!! session()->get('account_message') !!}
        @if (session()->has('account_link'))
            <br><a href="{{ session()->get('account_link') }}">{{ __('account::activation.resend') }}</a>
        @endif
    </div>
@endif