<style>
    .emailSending p {
        animation: shake 1s linear infinite;
        transform: translate3d(0, 0, 0);
        backface-visibility: hidden;
        perspective: 1000px;
    }
    @keyframes shake {
        10%, 90% { transform: translate3d(-1px, 0, 0); }
        40%, 60% { transform: translate3d(4px, 0, 0); }
    }

    /* Compact & Modern Login / Register Modal Overrides */
    #loginRegisterModal .main-register-holder {
        max-width: 430px !important;
        margin: 35px auto !important;
    }
    #loginRegisterModal .main-register {
        border-radius: 14px !important;
        overflow: hidden !important;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.35) !important;
        padding-bottom: 0 !important;
    }
    #loginRegisterModal .tabs-menu li a {
        padding: 14px 10px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        letter-spacing: 0.4px !important;
    }
    #loginRegisterModal .close-reg {
        top: 10px !important;
        right: 12px !important;
        width: 30px !important;
        height: 30px !important;
        line-height: 28px !important;
    }
    #loginRegisterModal #tabs-container {
        padding: 18px 24px 20px !important;
        margin-top: 0 !important;
    }
    #loginRegisterModal .main-register h3 {
        padding: 0 0 10px 0 !important;
        margin: 0 0 12px 0 !important;
        font-size: 19px !important;
        text-align: left !important;
        border-bottom: 1px solid #eef2f6 !important;
    }
    #loginRegisterModal .custom-form label {
        font-size: 12.5px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        padding-bottom: 4px !important;
        margin-bottom: 0 !important;
        text-align: left !important;
        display: block !important;
        float: none !important;
    }
    #loginRegisterModal .custom-form input[type="text"],
    #loginRegisterModal .custom-form input[type="email"],
    #loginRegisterModal .custom-form input[type="password"] {
        height: 38px !important;
        line-height: 38px !important;
        padding: 0 12px !important;
        margin-bottom: 10px !important;
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        background: #f8fafc !important;
        font-size: 13.5px !important;
        color: #0f172a !important;
        width: 100% !important;
        float: none !important;
        transition: border-color 0.2s, background 0.2s !important;
    }
    #loginRegisterModal .custom-form input[type="text"]:focus,
    #loginRegisterModal .custom-form input[type="email"]:focus,
    #loginRegisterModal .custom-form input[type="password"]:focus {
        border-color: #183c7d !important;
        background: #ffffff !important;
        outline: none !important;
    }
    #loginRegisterModal .wj-modal-pass-grid {
        display: flex !important;
        gap: 10px !important;
        width: 100% !important;
    }
    #loginRegisterModal .wj-modal-pass-col {
        flex: 1 1 50% !important;
        min-width: 0 !important;
    }
    #loginRegisterModal .wj-modal-options-row {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 100% !important;
        margin: 2px 0 12px 0 !important;
        clear: both !important;
    }
    #loginRegisterModal .wj-modal-options-row .filter-tags {
        margin: 0 !important;
        float: none !important;
        display: inline-flex !important;
        align-items: center !important;
    }
    #loginRegisterModal .wj-modal-options-row .filter-tags label {
        padding-bottom: 0 !important;
        font-size: 12.5px !important;
        color: #475569 !important;
    }
    #loginRegisterModal .wj-modal-options-row .lost_password {
        margin: 0 !important;
        float: none !important;
    }
    #loginRegisterModal .wj-modal-options-row .lost_password a {
        font-size: 12.5px !important;
        font-weight: 600 !important;
        color: #183c7d !important;
    }
    #loginRegisterModal .log-submit-btn {
        width: 100% !important;
        padding: 10px 16px !important;
        margin-top: 2px !important;
        border-radius: 8px !important;
        background: #183c7d !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        text-align: center !important;
        float: none !important;
        display: block !important;
        cursor: pointer !important;
        transition: background 0.2s ease !important;
    }
    #loginRegisterModal .log-submit-btn:hover {
        background: #1e40af !important;
    }
    #loginRegisterModal .log-separator {
        margin: 12px 0 8px 0 !important;
    }
    #loginRegisterModal .log-separator span {
        width: 30px !important;
        height: 24px !important;
        line-height: 24px !important;
        top: -12px !important;
        font-size: 11.5px !important;
    }
    #loginRegisterModal .soc-log {
        padding: 0 !important;
        margin: 0 !important;
    }
    #loginRegisterModal .soc-log p {
        font-size: 12px !important;
        color: #64748b !important;
        margin: 0 0 8px 0 !important;
        padding: 0 !important;
        line-height: 1.3 !important;
    }
    #loginRegisterModal .wj-soc-grid {
        display: flex !important;
        gap: 8px !important;
        width: 100% !important;
    }
    #loginRegisterModal .wj-soc-btn {
        flex: 1 1 33.33% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        height: 36px !important;
        line-height: 36px !important;
        border-radius: 8px !important;
        font-size: 12.5px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        text-decoration: none !important;
        padding: 0 8px !important;
        margin: 0 !important;
        transition: opacity 0.2s ease, transform 0.15s ease !important;
    }
    #loginRegisterModal .wj-soc-btn:hover {
        opacity: 0.92 !important;
        transform: translateY(-1px) !important;
    }
    #loginRegisterModal .wj-soc-fb { background: #1877F2 !important; }
    #loginRegisterModal .wj-soc-gg { background: #EA4335 !important; }
    #loginRegisterModal .wj-soc-gh { background: #24292F !important; }
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
                        <div class="loginErrMsgContainer"></div>
                        <div class="custom-form hide-custom-form">
                            <form action="" method="post" id="userLoginForm">
                                @csrf
                                <label for="l_email">{{ __('Email Address') }} <span>*</span></label>
                                <input id="l_email" type="email" placeholder="you@example.com">

                                <label for="l_password">{{ __('Password') }} <span>*</span></label>
                                <input id="l_password" type="password" placeholder="••••••••">

                                <div class="wj-modal-options-row">
                                    <div class="filter-tags">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">{{ __('Remember me') }}</label>
                                    </div>
                                    <div class="lost_password">
                                        <a href="#lostPasswordForm" id="lost_password">{{ __('Lost Your Password?') }}</a>
                                    </div>
                                </div>

                                <button type="submit" class="log-submit-btn" id="login_form_submit"><span>{{ __('Log In') }}</span></button>
                                <div class="clearfix"></div>
                            </form>
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
                                    <label for="name">{{ __('Full Name') }} <span>*</span></label>
                                    <input name="name" id="name" type="text" placeholder="John Doe">

                                    <label for="email">{{ __('Email Address') }} <span>*</span></label>
                                    <input name="email" id="email" type="text" placeholder="you@example.com">

                                    <div class="wj-modal-pass-grid">
                                        <div class="wj-modal-pass-col">
                                            <label for="password">{{ __('Password') }} <span>*</span></label>
                                            <input name="password" id="password" type="password" placeholder="••••••••">
                                        </div>
                                        <div class="wj-modal-pass-col">
                                            <label for="confirm_password">{{ __('Confirm Password') }} <span>*</span></label>
                                            <input name="confirm_password" id="confirm_password" type="password" placeholder="••••••••">
                                        </div>
                                    </div>

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
                            <label for="lost_password_email">{{ __('Email Address') }} <span>*</span></label>
                            <input id="lost_password_email" type="email" placeholder="Enter email for new password">
                            <button type="submit" class="log-submit-btn" id="lost_password_form_submit"><span>{{ __('Submit') }}</span></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    {{-- //lost password form end--}}
                </div>
                {{-- <!--tabs end -->--}}
                <div class="log-separator fl-wrap"><span>or</span></div>
                <div class="soc-log fl-wrap">
                    <p>{{ __('Fast login or register with your social account:') }}</p>
                    <div class="wj-soc-grid">
                        <a href="{{ route('facebook.login') }}" class="wj-soc-btn wj-soc-fb"><i class="fab fa-facebook-f"></i> {{ __('Facebook') }}</a>
                        <a href="{{ route('google.login') }}" class="wj-soc-btn wj-soc-gg"><i class="fab fa-google"></i> {{ __('Google') }}</a>
                        <a href="{{ route('github.login') }}" class="wj-soc-btn wj-soc-gh"><i class="fab fa-github"></i> {{ __('GitHub') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->
