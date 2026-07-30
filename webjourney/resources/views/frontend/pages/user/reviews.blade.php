@extends('frontend.layouts.master')

@section('site_title','Your Reviews - WebJourney')

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <x-frontend.breadcrumb />
            <!-- section-->
            <section class="flat-header color-bg adm-header">
                <div class="wave-bg wave-bg2"></div>
                <div class="container">
                    <div class="dasboard-wrap fl-wrap">
                        @include('frontend.pages.user.partials.sidebar')
                        @include('frontend.pages.user.partials.menu')
                    </div>
                </div>
            </section>
            <!-- section end-->
            <!-- section-->
            <section class="middle-padding">
                <div class="container">
                    <!--dasboard-wrap-->
                    <div class="dasboard-wrap fl-wrap">
                        <!-- dashboard-content-->
                        <div class="dashboard-content fl-wrap">
                            <div class="dashboard-list-box fl-wrap">
                                <div class="dashboard-header fl-wrap">
                                    <h3>{{ __('Your Reviews') }}</h3>
                                </div>
                                <div class="reviews-comments-wrap">
                                    <!-- reviews-comments-item -->
                                    @if($reviews->count() >=1)
                                    @foreach($reviews as $review)
                                        <div class="reviews-comments-item">
                                            <div class="reviews-comments-item-text">
                                                <h4><a href="{{ route('post.details',optional($review->post)->slug) }}" target="_blank" class="reviews-comments-item-link">{{ optional($review->post)->title }}</a></h4>
                                                <div class="clearfix"></div>
                                                <p>{{ $review->comment }}</p>
                                                <div class="reviews-comments-item-date"><span><i class="far fa-calendar-check"></i>{{ $review->created_at->toFormattedDateString() }}</span></div>
                                            </div>
                                        </div>
                                     @endforeach
                                    @else
                                        <div class="reviews-comments-item">
                                            <div class="reviews-comments-item-text">
                                                <div class="clearfix"></div>
                                                <p>{{ __('You have no reviews') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <!--reviews-comments-item end-->
                                </div>
                            </div>
                            <!-- pagination-->
                            <div class="pagination">
                                {!! $reviews->links() !!}
                            </div>
                        </div>
                        <!-- dashboard-list-box end-->
                    </div>
                    <!-- dasboard-wrap end-->
                </div>
            </section>
            <div class="limit-box fl-wrap"></div>
            <!-- section end-->
        </div>
        <!-- content end-->
    </div>
    <!--wrapper end -->
@endsection

