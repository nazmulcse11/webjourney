@extends('frontend.layouts.master')

@section('site_title','WebJourney - PHP, Laravel, MySql, Javascript, Jquery, Vue Js, Tutorial')

@section('css')

@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <x-frontend.breadcrumb />
            <!-- section-->
            <section class="grey-blue-bg small-padding">
                <div class="container">
                    <div class="row">
                        <!--listing -->
                        <div class="col-md-12">
                            <!--col-list-wrap -->
                            <div class="col-list-wrap fw-col-list-wrap">
                                <!-- list-main-wrap-->
                                <div class="list-main-wrap fl-wrap card-listing">
                                    <!-- list-main-wrap-opt-->
                                    <div class="list-main-wrap-opt fl-wrap">
                                        <div class="list-main-wrap-title fl-wrap col-title">
                                            <h2>Available : <span>Courses </span></h2>
                                        </div>
                                    </div>
                                    <!-- list-main-wrap-opt end-->
                                    <!-- listing-item-container -->
                                    <div class="listing-item-container init-grid-items fl-wrap three-columns-grid">
                                        <!-- listing-item  -->
                                        @foreach($courses as $course)
                                            <div class="listing-item has_one_column">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    <a href="listing-single.html">
                                                        {!! $course->video !!}
                                                    </a>
{{--                                                    <div class="sale-window big-sale">Sale 70%</div>--}}
{{--                                                    <div class="geodir-category-opt">--}}
{{--                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>--}}
{{--                                                        <div class="rate-class-name">--}}
{{--                                                            <div class="score"><strong> Good</strong>8 Reviews </div>--}}
{{--                                                            <span>4.1</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h3 class="title-sin_map">
                                                                <a href="{{ route('user.course.playlist') }}">{{ $course->title }}</a>
                                                                <a href="{{ route('user.course.playlist') }}">{{ __('Play List') }}</a>
                                                            </h3>
                                                            <div class="geodir-category-location fl-wrap">
                                                                <h1 class="sin_map">
                                                                    <a href="#5" class="map-item">
                                                                        BDT.{{ $course->price }}TK <span>{{ __('Buy Now') }}</span>
                                                                    </a>
                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>{!! $course->description !!}</p>
                                                    <div class="geodir-category-footer fl-wrap"></div>
                                                </div>
                                            </article>
                                        </div>
                                        @endforeach
                                        <!-- listing-item end -->
                                    </div>
                                    <!-- listing-item-container end-->
                                </div>
                                <!-- list-main-wrap end-->
                            </div>
                            <!--col-list-wrap end -->
                        </div>
                        <!--listing  end-->
                    </div>
                    <!--row end-->
                </div>
            </section>
            <!-- section end -->
        </div>
        <!-- content end-->
    </div>
    <!--wrapper end -->
@endsection

