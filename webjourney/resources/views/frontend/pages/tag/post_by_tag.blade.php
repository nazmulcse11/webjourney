@extends('frontend.layouts.master')
@php
    $tagTitle = $tag->name . ' Tutorials & Articles - WebJourney';
    $tagDesc = 'Browse tutorials, code examples, and developer guides tagged with ' . $tag->name . ' on WebJourney.';
@endphp
@section('robots', 'noindex, follow')
@section('site_title'){{ $tagTitle }}@endsection
@section('description'){{ $tagDesc }}@endsection
@section('og_url'){{ route('tag.tutorial',$tag->slug) }}@endsection
@section('og_title'){{ $tagTitle }}@endsection
@section('og_description'){{ $tagDesc }}@endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}}@endsection
@section('css')
    <style>
        li.page-item.active {
            background: #F9B90F;;
            color: white;
        }
        .page-item:first-child .page-link,
        .page-item:last-child .page-link{
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
            width: 44px;
            height: 44px;
            line-height: 44px;
            display: inline;
            padding-top: 15px;
            border-radius: 5px;
            background: none;
            border: 0;
        }
        .page-link:hover {
            color: unset;
        }
    </style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">

            <x-frontend.dynamic-breadcrumb :title="__('Tag: ').$tag->name" />
            <!-- section-->
            <section  id="sec1" class="middle-padding grey-blue-bg">
                <div class="container">
                    <div class="row">
                        @include('frontend.pages.partials.pagination_post_markup')
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

