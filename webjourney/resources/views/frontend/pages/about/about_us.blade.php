@extends('frontend.layouts.master')
@section('site_title'){{ 'WebJourney - About Us'}}@endsection
@section('og_url'){{ route('about.us') }}@endsection
@section('og_title','WebJourney - About Us')
@section('og_description'){{ 'WebJourney makes tutorial such a way so that everyone can learn and build their career in web development.'}}@endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}}@endsection
@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <x-frontend.dynamic-breadcrumb :title="__('About Us')" />
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
                                            <h3>{{ __('Web Journey For Everyone.') }}</h3>
                                        </div>
                                        <p>{{ __("Web Journey makes tutorial such a way so that everyone can learn and build their career in web development. We always respect your interest and effort in learning and that is why we always provide content for free so that you can learn well.")}}</p>
                                        <p> {{ __("We don't just provide tutorials for views
                                            we create content thinking about how our visitors will benefit. Once you see it, you will understand.") }}</p>
                                        <span class="fw-separator"></span>

                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __("Let's discuss what mistakes we do.") }}</h3>
                                        </div>

                                        <p>
                                            {{ __("We attach great importance to the quality of content. If there's something irrelevant, grammatical error, page doesn't look good on your device, no link
                                                 works let us know. We will take your work with respect.") }}
                                        </p>
                                        <p>{{ __('Please message us with the page link if any page break or an issue. For messaging use') }} <a style="color:#3AACED" target="_blank" href="{{route('contact.us')}}"> {{ __('Contact Us Form') }}</a> .</p>
                                        <span class="fw-separator"></span>
                                
                                        
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __("Web Journey build functional websites!") }}</h3>
                                        </div>

                                        <p>
                                            {{ __("We are a team of passionate web developers and designers who believe that every business deserves a strong online presence. Our mission is to help businesses create beautiful and functional websites that attract customers and generate leads.") }}
                                        </p>
                                        <p>
                                            {{ __("At Web Journey, we specialize in creating custom websites that are tailored to the unique needs of each business.Our team has years of experience in developing websites for various industries, including e-commerce, healthcare, real estate, education, and more.") }}
                                        </p>
                                        <p>
                                            {{ __("We understand that a website is more than just an online presence - it's a powerful marketing tool that can help your business grow. That's why we work closely with our clients to understand their goals, target audience, and brand identity to create a website that aligns with their business objectives.") }}
                                        </p>
                                        <p>
                                            {{ __("We use the latest technologies and best practices to ensure that your website is secure, mobile-friendly, and easy to navigate. Our team is proficient in various programming languages such as HTML, CSS, JavaScript, jQuery, vue js, react js, PHP, Laravel and more.") }}
                                        </p>
                                        <p>
                                            {{ __("In addition to website development, we offer a range of services such as website maintenance, search engine optimization (SEO), and website redesign. Our goal is to be a one-stop-shop for all your website needs, so you can focus on growing your business.") }}
                                        </p>
                                        <p>
                                            {{ __("At Web Journey, we are committed to providing exceptional customer service and delivering high-quality results. We believe in building long-term relationships with our clients and supporting them throughout their online journey.") }}
                                        </p>
                                        <p>
                                            {{ __("If you're looking for a reliable web development partner, we'd be happy to work with you.")}} <a style="color:#3AACED" target="_blank" href="{{route('contact.us')}}"> {{ __('Contact Us') }}</a>  {{ __("today to schedule a consultation and let's start your web journey together!") }}
                                        </p>
                                        <span class="fw-separator"></span>
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

