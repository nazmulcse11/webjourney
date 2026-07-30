@if(Auth::guard('web')->check())
    <div class="header-user-menu">
        <div class="header-user-name">
            <span><i style="font-size:32px;" class="fas fa-user-circle"></i></span>{{ __('My account') }}
        </div>
        <ul>
            <li><a href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('user.logout') }}">{{ __('Log Out') }}</a></li>
        </ul>
    </div>
@else
    <div class="show-reg-form modal-open"><i class="fa fa-sign-in"></i>{{ __('Sign In') }}</div>
@endif
