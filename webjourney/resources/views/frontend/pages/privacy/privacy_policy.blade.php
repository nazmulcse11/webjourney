@extends('frontend.layouts.master')
@section('site_title'){{ 'WebJourney - Privacy Policy'}}@endsection
@section('description',get_static_option('description'))
@section('og_url'){{ route('privacy.policy') }}@endsection
@section('og_title','WebJourney - Privacy Policy')
@section('og_description'){{ 'We assure that your privacy is fully protected. This policy covers the actions when you visit WebJourney.info website'}}@endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}}@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
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
                                            <h3>{{ __('Privacy Policy') }}</h3>
                                        </div>
                                        <p style="color:#24A28E;font-size:20px;">{{ __('WebJourney.dev may update the privacy policy at any time.') }}</p>
                                        <p>
                                            {{ __('We assure that your privacy is fully protected. This policy covers the actions when you visit webjourney.dev website. WebJourney.dev
                                            may collect your brower information, your ip address, time of visit, your geographical location, referring Site, service, software
                                            and hardware attributes etc. These are the common actions that every other websites do through the internet.') }}
                                        </p>
                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Your Personal Information') }}</h3>
                                        </div>
                                        <p>
                                            {{ __('We value your privacy and we will do everything possible to keep your information secret. We will never share your information to other companies
                                            for any reason.') }}
                                        </p>
                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Cookies Policy') }}</h3>
                                        </div>
                                        <p>
                                            {{ __('Webjourney.dev cookies give extra opportunities to its visitors. webjourney.dev do not commit any kind of illegal activities by cookies
                                            system.') }}
                                        </p>

                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('External Link') }}</h3>
                                        </div>
                                        <p>
                                            {{ __('Webjourney.dev may contain links to other websites. Since we do not control those websites, we are not responsible for the protection and privacy of any information which you provide while visiting such websites.') }}
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

