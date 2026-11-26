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
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.4) !important;
        padding: 0 !important;
        background: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
    }

    /* Modern Top Header with Segmented Pill Tabs + Separate Close Button */
    #loginRegisterModal .wj-modal-topbar {
        background: #f8fafc !important;
        padding: 12px 54px 12px 18px !important;
        border-bottom: 1px solid #e2e8f0 !important;
        position: relative !important;
        width: 100% !important;
        box-sizing: border-box !important;
        float: left !important;
    }
    #loginRegisterModal .tabs-menu {
        display: flex !important;
        float: none !important;
        width: 100% !important;
        background: #e2e8f0 !important;
        padding: 4px !important;
        border-radius: 10px !important;
        margin: 0 !important;
        list-style: none !important;
        box-sizing: border-box !important;
    }
    #loginRegisterModal .tabs-menu li {
        flex: 1 1 50% !important;
        width: 50% !important;
        float: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    #loginRegisterModal .tabs-menu li a {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 7px !important;
        float: none !important;
        width: 100% !important;
        padding: 9px 12px !important;
        border-radius: 8px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        letter-spacing: 0.3px !important;
        text-transform: uppercase !important;
        text-align: center !important;
        background: transparent !important;
        color: #475569 !important;
        transition: all 0.2s ease !important;
        box-sizing: border-box !important;
    }
    #loginRegisterModal .tabs-menu li a i {
        padding: 0 !important;
        margin: 0 !important;
        font-size: 13px !important;
        color: inherit !important;
        position: static !important;
    }
    #loginRegisterModal .tabs-menu li.current a {
        background: #183c7d !important;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(24, 60, 125, 0.25) !important;
    }
    #loginRegisterModal .tabs-menu li.current a i {
        color: #F9B90F !important;
    }
    #loginRegisterModal .close-reg {
        position: absolute !important;
        top: 50% !important;
        right: 14px !important;
        transform: translateY(-50%) !important;
        width: 32px !important;
        height: 32px !important;
        line-height: 30px !important;
        border-radius: 50% !important;
        background: #e2e8f0 !important;
        color: #334155 !important;
        border: 1px solid #cbd5e1 !important;
        text-align: center !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
    }
    #loginRegisterModal .close-reg:hover {
        background: #ef4444 !important;
        color: #ffffff !important;
        border-color: #ef4444 !important;
    }

    /* Inner Container */
    #loginRegisterModal #tabs-container {
        padding: 16px 24px 20px !important;
        margin-top: 0 !important;
        box-sizing: border-box !important;
    }
    #loginRegisterModal .tab-content {
        padding: 0 !important;
    }
    #loginRegisterModal .main-register h3 {
        padding: 0 0 10px 0 !important;
        margin: 0 0 12px 0 !important;
        font-size: 18px !important;
        text-align: left !important;
        border-bottom: 1px solid #eef2f6 !important;
        color: #334155 !important;
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
        box-sizing: border-box !important;
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

    /* Remember Me & Lost Password Row */
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
        gap: 7px !important;
    }
    #loginRegisterModal .wj-modal-options-row .filter-tags input[type="checkbox"] {
        float: none !important;
        margin: 0 !important;
        top: 0 !important;
        width: 16px !important;
        height: 16px !important;
        border-radius: 4px !important;
        border: 1.5px solid #94a3b8 !important;
        display: inline-block !important;
    }
    #loginRegisterModal .wj-modal-options-row .filter-tags input[type="checkbox"]:checked:after {
        top: 0px !important;
        left: 2px !important;
        font-size: 10px !important;
    }
    #loginRegisterModal .wj-modal-options-row .filter-tags label {
        float: none !important;
        top: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
        color: #475569 !important;
        cursor: pointer !important;
        display: inline !important;
    }
    #loginRegisterModal .wj-modal-options-row .lost_password {
        margin: 0 !important;
        float: none !important;
    }
    #loginRegisterModal .wj-modal-options-row .lost_password a {
        float: none !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
        color: #183c7d !important;
    }

    /* Submit Button */
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

    /* Separator & 3-Column Social Buttons (Resetting style.css .soc-log a & i) */
    #loginRegisterModal .log-separator {
        margin: 14px 0 10px 0 !important;
    }
    #loginRegisterModal .log-separator span {
        width: 36px !important;
        height: 22px !important;
        line-height: 22px !important;
        top: 0 !important;
        font-size: 12px !important;
        color: #64748b !important;
    }
    #loginRegisterModal .soc-log {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    #loginRegisterModal .soc-log p {
        font-size: 12px !important;
        color: #64748b !important;
        margin: 0 0 8px 0 !important;
        padding: 0 !important;
        line-height: 1.3 !important;
        text-align: center !important;
    }
    #loginRegisterModal .wj-soc-grid {
        display: flex !important;
        gap: 8px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    #loginRegisterModal .soc-log a.wj-soc-btn {
        flex: 1 1 33.33% !important;
        width: auto !important;
        float: none !important;
        position: static !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        height: 36px !important;
        line-height: 1 !important;
        border-radius: 8px !important;
        font-size: 12.5px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        text-decoration: none !important;
        padding: 0 10px !important;
        margin: 0 !important;
        text-align: center !important;
        box-sizing: border-box !important;
        transition: opacity 0.2s ease, transform 0.15s ease !important;
    }
    #loginRegisterModal .soc-log a.wj-soc-btn i {
        position: static !important;
        width: auto !important;
        height: auto !important;
        line-height: 1 !important;
        border: none !important;
        margin: 0 !important;
        padding: 0 !important;
        font-size: 13.5px !important;
        color: #ffffff !important;
        display: inline-block !important;
    }
    #loginRegisterModal .soc-log a.wj-soc-btn:hover {
        opacity: 0.92 !important;
        transform: translateY(-1px) !important;
    }
    #loginRegisterModal .soc-log a.wj-soc-fb { background: #1877F2 !important; }
    #loginRegisterModal .soc-log a.wj-soc-gg { background: #EA4335 !important; }
    #loginRegisterModal .soc-log a.wj-soc-gh { background: #24292F !important; }
</style>

<!--register form -->
<div class="main-register-wrap modal" id="loginRegisterModal">
    <div class="reg-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="wj-modal-topbar">
                <ul class="tabs-menu">
                    <li class="current">
                        <a href="#tab-1"><i class="fal fa-sign-in-alt"></i> {{ __('Login') }}</a>
                    </li>
                    <li>
                        <a href="#tab-2"><i class="fal fa-user-plus"></i> {{ __('Register') }}</a>
                    </li>
                </ul>
                <div class="close-reg"><i class="fal fa-times"></i></div>
            </div>

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
                        <a href="{{ route('facebook.login') }}" class="wj-soc-btn wj-soc-fb"><i class="fab fa-facebook-f"></i> <span>{{ __('Facebook') }}</span></a>
                        <a href="{{ route('google.login') }}" class="wj-soc-btn wj-soc-gg"><i class="fab fa-google"></i> <span>{{ __('Google') }}</span></a>
                        <a href="{{ route('github.login') }}" class="wj-soc-btn wj-soc-gh"><i class="fab fa-github"></i> <span>{{ __('GitHub') }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->
