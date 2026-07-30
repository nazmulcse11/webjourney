@extends('frontend.layouts.master')

@section('site_title','Verify Your Email')

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <x-frontend.breadcrumb />
            <!-- section-->
            <section  id="sec1" class="middle-padding grey-blue-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="list-single-main-item fl-wrap">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>{{ __('Verification code is send to your email. Check email.') }}</h3>
                                </div>

                                <x-frontend.v_error />

                                <div id="email-verify-form">
                                    <form method="post" class="custom-form" action="{{ route('email.verify') }}">
                                        @csrf
                                        <fieldset>
                                            <label><i class="fal fa-user"></i></label>
                                            <input type="text" name="email_verify_token" placeholder="Enter code and verify email*" value="{{ old('name') }}" required />
                                            <div class="clearfix"></div>
                                        </fieldset>
                                        <button type="submit" class="btn float-btn color2-bg" style="margin-top:15px;">{{__('Verify Email')}}<i class="fal fa-angle-right"></i></button>
                                    </form>
                                </div>
                                <!-- contact form  end-->
                            </div>
                        </div>
                        <div class="col-md-3"></div>

                    </div>
                </div>
                <div class="limit-box fl-wrap"></div>
            </section>
            <!-- section end -->
        </div>
        <!-- content end-->
    </div>
    <!--wrapper end -->
@endsection

