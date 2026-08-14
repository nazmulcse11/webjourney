@extends('frontend.layouts.master')
@section('site_title'){{ 'WebJourney - Terms of use'}}@endsection
@section('description',get_static_option('description'))
@section('og_url'){{ route('terms.of.use') }}@endsection
@section('og_title','WebJourney - Terms of use')
@section('og_description'){{ 'WebJourney welcomes you for using our online information service. By using our service, you are agreeing with our terms and conditions.'}}@endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}}@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <x-frontend.dynamic-breadcrumb :title="__('Terms of Use')" />
            <!-- section-->
            <section  id="sec1" class="middle-padding grey-blue-bg">
                <div class="container">
                    <div class="row">
                        <!--blog content -->
                        <div class="col-md-8">
                            <!--post-container -->
                            <div class="post-container fl-wrap">
                                <!-- article> -->
                                <article class="post-article">
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Terms of Use') }}</h3>
                                        </div>
                                        <p style="color:#24A28E;font-size:20px;">{{ __('Webjourney.dev may update the terms of use at any time.') }}</p>
                                        <p>{{ __('Webjourney welcomes you for using our online information service. By using our service, you are agreeing with our terms and conditions.') }}</p>

                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Our Services') }}</h3>
                                        </div>

                                        <p>
                                            {{ __('Webjourney helps to learn web technology. It provides you totally free online tutorials on web development.
                                                  Our service includes PHP, Laravel, JavaScript, Vue, React, Next js and many more. We have
                                                  different types of courses like ecommerce website development, blog website development, API development using laravel, laravel live chat application etc. Besides we are working on new tutorial each day to add new things.') }}
                                        </p>
                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Privacy Policy') }}</h3>
                                        </div>
                                        <p>
                                            {{ __('We care your privacy. To know about our privacy policy, please visit our') }}
                                            <a href="{{ route('privacy.policy') }}">{{ __('privacy policy.') }}</a>
                                        </p>
                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Restrictions') }}</h3>
                                        </div>
                                        <p>
                                            {{ __('According to our terms and conditions you agree that') }} <br>
                                            1. {{ __('You will not trying to misuse of WebJourney content by breaking copyright.') }} <br>
                                            2. {{ __('You will not use automated software to break the flow of service.') }} <br>
                                            3. {{ __('You will not trying to spamming.') }} <br>
                                            4. {{ __('WebJourney, visitors are not allowed to copy, publish, distribute, or use any text for commercial purposes.') }}
                                        </p>
                                    </div>
                                </article>
                                <!-- article end -->
                            </div>
                            <!--post-container end -->
                        </div>
                        <!-- blog content end -->
                        @include('frontend.pages.partials.sidebar')
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

