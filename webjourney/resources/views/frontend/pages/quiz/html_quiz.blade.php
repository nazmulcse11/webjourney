@extends('frontend.layouts.master')
@section('site_title'){{__('Webjourney')}} - {{ ucwords(str_replace('-',' ',$type->slug )) }}@endsection
@section('description',get_static_option('description'))
@section('og_url'){{ route('quiz.tutorial',$type->slug ) }}@endsection
@section('og_title'){{ ucwords(str_replace('-',' ',$type->slug )) }}@endsection
@section('og_description'){{ ucwords(str_replace('-',' ',$type->slug )) }}{{ '-Check Your Skill'}}@endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}}@endsection

@section('style')
<style>
    .answer-block{
        display:none;
    }
</style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
             <!--Horizontal ads -->
            <section class="middle-padding ">
                <div class="container">
                    <div class="flat-title-wrap">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8673885649672159" crossorigin="anonymous"></script>
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8673885649672159"
                             data-ad-slot="1123428994"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </section>
            <!--  ads  end-->
             <x-frontend.dynamic-breadcrumb :title="ucwords(str_replace('-',' ',$type->slug ))" />
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
                                            <h3 style="text-align: left">{{ ucwords(str_replace('-',' ',$type->slug )) }} ({{ $quizzes->count() }})</h3>
                                        </div>
                                        <form>
                                            @include('frontend.pages.quiz.partials.quiz_markup')
                                        </form>
                                    </div>
                                </article>
                                <!-- article end -->
                            </div>
                            <!--post-container end -->
                        </div>
                        <!-- blog content end -->
                        @include('frontend.pages.quiz.partials.sidebar')
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

@section('scripts')
    @include('frontend.pages.quiz.partials.quiz_js')
@endsection

