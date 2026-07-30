<!--dasboard-sidebar-->
<div class="dasboard-sidebar">
    <div class="dasboard-sidebar-content fl-wrap">
        <div class="dasboard-avatar">
            <img src="{{ asset('frontend/images/avatar/1.jpg') }}" alt="{{ __('Profile Image') }}">
        </div>
        <div class="dasboard-sidebar-item fl-wrap">
            @if(Auth::guard('web')->check())
                <a href="{{ route('user.dashboard') }}">
                <h3 style="text-align: center;float:none">
                    <span>{{ __('Dashboard') }}</span>
                    {{ Auth::guard('web')->user()->name }}
                </h3>
                </a>
            @endif
        </div>
        <a href="{{ route('user.courses') }}" class="ed-btn">{{ __('Courses') }}</a>
        <div class="user-stats fl-wrap">
            <ul>
                <li>
                    {{ __('Like') }}
                    <span>{{ Auth::guard('web')->user()->likes->count() }}</span>
                </li>
                <li>
                    {{ __('Favourite') }}
                    <span>{{ Auth::guard('web')->user()->favourites->count() }}</span>
                </li>
                <li>
                    {{ __('Reviews') }}
                    <span>{{ Auth::guard('web')->user()->comments->count() }}</span>
                </li>
            </ul>
        </div>
        <a href="{{ route('user.logout') }}" class="log-out-btn color-bg">{{ __('Log Out') }}<i class="far fa-sign-out"></i></a>
    </div>
</div>
<!--dasboard-sidebar end-->
