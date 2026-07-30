<style>
    .emailSending p{
        animation: shake 1s linear infinite;
        transform: translate3d(0, 0, 0);
        backface-visibility: hidden;
        perspective: 1000px;
    }
    @keyframes shake {
        10%, 90% {
            transform: translate3d(-1px, 0, 0);
        }
        40%, 60% {
            transform: translate3d(4px, 0, 0);
        }
    }
</style>

<!--register form -->
<div class="main-register-wrap modal" id="loginRegisterModal">
    <div class="reg-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg color-bg"><i class="fal fa-times"></i></div>
            <ul class="tabs-menu">
                <li class="current">
                    <a href="#tab-1"><i class="fal fa-sign-in-alt"></i>{{ __('Login') }}</a>
                </li>
                <li>
                    <a href="#tab-2"><i class="fal fa-user-plus"></i>{{ __('Register') }}</a>
                </li>
            </ul>
            <!--tabs -->
            <div id="tabs-container">
                <div class="tab">
                    <!--tab -->
                    <div id="tab-1" class="tab-content">
                        <h3>{{ __('Sign In') }} <span>{{ __('Web') }}<strong>{{ __('Journey') }}</strong></span></h3>
                        <br>
                        <div class="loginErrMsgContainer"></div>
                        <div class="custom-form hide-custom-form">
                            <form action="" method="post" id="userLoginForm">
                                @csrf
                                <label>{{ __('Email Address') }} <span>*</span> </label>
                                <input id="l_email" type="email">

                                <label>{{ __('Password') }} <span>*</span> </label>
                                <input id="l_password" type="password">

                                <button type="submit"  class="log-submit-btn" id="login_form_submit"><span>{{ __('Log In') }}</span></button>
                                <div class="clearfix"></div>

                                <div class="filter-tags">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">{{ __('Remember me') }}</label>
                                </div>

                            </form>
                            <div class="lost_password">
                                <a href="#" id="lost_password">{{ __('Lost Your Password?') }}</a>
                            </div>
                        </div>
                    </div>
                    <!--tab end -->
                    <!--tab -->
                    <div class="tab">
                        <div id="tab-2" class="tab-content">
                            <h3>{{ __('Sign Up') }} <span>{{ __('Web') }}<strong>{{ __('Journey') }}</strong></span></h3>
                            <div class="errMsgContainer"></div>
                            <div class="emailSending"></div>
                            <div class="custom-form hide-custom-form">
                                <form method="post" action="{{ route('user.register') }}" class="main-register-form" id="main-register-form2">
                                    @csrf
                                    <label>{{ __('Full Name') }} <span>*</span> </label>
                                    <input name="name" id="name" type="text">

                                    <label>{{ __('Email Address') }} <span>*</span></label>
                                    <input name="email" id="email" type="text">

                                    <label>{{ __('Password') }} <span>*</span></label>
                                    <input name="password" id="password" type="password">

                                    <label>{{ __('Confirm Password ') }} <span>*</span></label>
                                    <input name="confirm_password" id="confirm_password" type="password">

                                    <button type="submit" class="log-submit-btn user_register_btn"><span>{{ __('Register') }}</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--tab end -->
                    {{-- //lost password form--}}
                    <div class="custom-form lostPasswordFormWrapper" style="display:none">
                        <h3>{{ __('Lost') }} <span>{{ __('Your') }}<strong>{{ __(' Password') }}</strong></span></h3>
                        <div class="errMsgContainer"></div>
                        <div class="emailSending"></div>
                        <form action="" method="post" id="lostPasswordForm">
                            @csrf
                            <label>{{ __('Email Address') }} <span>*</span> </label>
                            <input id="lost_password_email" type="email" placeholder="Enter email for new password">
                            <button type="submit"  class="log-submit-btn" id="lost_password_form_submit"><span>{{ __('Submit') }}</span></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    {{-- //lost password form end--}}
                </div>
                {{-- <!--tabs end -->--}}
                <div class="log-separator fl-wrap"><span>or</span></div>
                <div class="soc-log fl-wrap">
                    <p>{{ __('For faster login or register use your social account.') }}</p>
                    <a href="{{ route('facebook.login') }}" class="facebook-log"><i class="fab fa-facebook-f"></i>{{ __('Connect with Facebook') }}</a>
                    <a href="{{ route('google.login') }}" class="facebook-log"><i class="fab fa-google"></i>{{ __('Connect with Google') }}</a>
                    <a href="{{ route('github.login') }}" class="facebook-log"><i class="fab fa-github"></i>{{ __('Connect with Github') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->
