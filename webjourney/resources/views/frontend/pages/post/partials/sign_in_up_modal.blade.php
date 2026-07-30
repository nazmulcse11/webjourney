<!--register form -->
<div class="main-register-wrap modal" id="loginRegisterModal">
    <div class="reg-overlay2"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg color-bg"><i class="fal fa-times"></i></div>
            <ul class="tabs-menu">
                <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i>{{ __('Login') }}</a></li>
                <li><a href="#tab-2"><i class="fal fa-user-plus"></i>{{ __('Register') }}</a></li>
            </ul>
            <!--tabs -->
            <div id="tabs-container">
                <div class="tab">
                    <!--tab -->
                    <div id="tab-1" class="tab-content">
                        <h3>{{ __('Sign In2') }} <span>{{ __('Web') }}<strong>{{ __('Journey') }}</strong></span></h3>
                        <div class="loginErrMsgContainer"></div>
                        <div class="custom-form">
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
                                <a href="#">{{ __('Lost Your Password?') }}</a>
                            </div>
                        </div>
                    </div>
                    <!--tab end -->
                    <!--tab -->
                    <div class="tab">
                        <div id="tab-2" class="tab-content">
                            <h3>{{ __('Sign Up') }} <span>{{ __('Web') }}<strong>{{ __('Journey') }}</strong></span></h3>
                            <div class="errMsgContainer"></div>
                            <div class="custom-form">
                                <form method="post" class="main-register-form" id="main-register-form2">
                                    @csrf
                                    <label>{{ __('Full Name') }} <span>*</span> </label>
                                    <input id="name" type="text">

                                    <label>{{ __('Email Address') }} <span>*</span></label>
                                    <input id="email" type="text">

                                    <label>{{ __('Password') }} <span>*</span></label>
                                    <input id="password" type="password">

                                    <label>{{ __('Confirm Password ') }} <span>*</span></label>
                                    <input id="confirm_password" type="password">

                                    <button type="button" class="log-submit-btn user_register_btn"  ><span>{{ __('Register') }}</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--tab end -->
                </div>
                <!--tabs end -->
                <div class="log-separator fl-wrap"><span>or</span></div>
                <div class="soc-log fl-wrap">
                    <p>For faster login or register use your social account.</p>
                    <a href="#" class="facebook-log"><i class="fab fa-facebook-f"></i>Connect with Facebook</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->
