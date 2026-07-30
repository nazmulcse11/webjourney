@extends('frontend.layouts.master')

@section('site_title','Favourite Posts - WebJourney')

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
                            <!-- dashboard-list-box-->
                            <div class="dashboard-list-box fl-wrap activities">
                                <div class="dashboard-header fl-wrap">
                                    <h3>{{ __('Your Favourite Post') }}</h3>
                                </div>
                                @php
                                    if(Auth::guard('web')->check()){
                                        $favourite_posts = \App\Models\AddToFavourite::where('user_id',Auth::guard('web')->user()->id)->latest()->take(20)->get();
                                    }
                                @endphp

                                @if($favourite_posts->count() >= 1)
                                    <div class="user-favourite-post-area">
                                        <!-- dashboard-list-->
                                        @foreach($favourite_posts as $post)
                                            <div class="dashboard-list">
                                                <div class="dashboard-message">
                                                    <span class="new-dashboard-item remove-favourite-post" data-post_id="{{ optional($post->post)->id }}"><i class="fal fa-times"></i></span>
                                                    <div class="dashboard-message-text">
                                                        <p><i class="far fa-check"></i><a href="{{ route('post.details',optional($post->post)->slug) }}">{{ optional($post->post)->title }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    <!-- dashboard-list end-->
                                    </div>
                               @else
                                <!-- dashboard-list-->
                                    <div class="dashboard-list">
                                        <div class="dashboard-message">
                                            <div class="dashboard-message-text">
                                                <p><i class="far fa-check"></i>{{ __('No favourite post yet.') }}</p>
                                                <p><i class="far fa-check"></i>{{ __('Add post to your favourite list') }}</p>
                                                <p><i class="far fa-check"></i>{{ __('Favourite post only come if you have added post to your favourite list.') }}</p>
                                                <p><i class="far fa-check"></i>{{ __('Add favourite post so that you can find this post very easily.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                <!-- dashboard-list end-->
                               @endif
                            </div>
                            <!-- dashboard-list-box end-->
                        </div>
                        <!-- dashboard-list-box end-->
                    </div>
                    <!-- dasboard-wrap end-->
                </div>
            </section>
            <!-- section end-->
            <div class="limit-box fl-wrap"></div>
        </div>
        <!-- content end-->
    </div>
    <!--wrapper end -->
@endsection

