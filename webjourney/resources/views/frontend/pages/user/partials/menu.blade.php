<!-- dasboard-menu-->
<div class="dasboard-menu">
    <div class="dasboard-menu-btn color3-bg">{{ __('Dashboard Menu') }} <i class="fal fa-bars"></i></div>
    <ul class="dasboard-menu-wrap">
        <li>
            <a href="{{ route('user.dashboard') }}" class="{{ request()->is('user/dashboard') || request()->is('user/profile') || request()->is('user/password') ? 'user-profile-act' : '' }}"><i class="far fa-user"></i>{{ __('Profile') }}</a>
            <ul>
                <li><a href="{{ route('user.profile') }}">{{ __('Edit profile') }}</a></li>
                <li><a href="{{ route('user.password') }}">{{ __('Change Password') }}</a></li>
            </ul>
        </li>
        <li><a href="{{ route('user.favourites') }}" class="{{ request()->is('user/favourites') ? 'user-profile-act' : '' }}"><i class="far fa-heart"></i> {{ __('Favourites') }} <span>{{ Auth::guard('web')->user()->favourites->count() }}</span></a></li>
        <li><a href="{{ route('user.courses') }}" class="{{ request()->is('user/courses') ? 'user-profile-act' : '' }}"><i class="far fa-calendar-check"></i> {{ __('Courses') }} <span>0</span></a></li>
        <li><a href="{{ route('user.reviews') }}" class="{{ request()->is('user/reviews') ? 'user-profile-act' : '' }}"><i class="far fa-comments"></i> {{ __('Reviews') }} <span>{{ Auth::guard('web')->user()->comments->count() }}</span></a></li>
    </ul>
</div>
<!--dasboard-menu end-->
