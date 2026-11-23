@extends('frontend.layouts.master')
    @php
        $subTitle = $subcategory->name . ' Tutorials & Practical Guides - WebJourney';
        $subDesc = 'Master ' . $subcategory->name . ' with practical tutorials, working code snippets, and step-by-step web development guides on WebJourney.';
        $subUrl = route('subcategory.tutorial', $subcategory->slug);
    @endphp
    @section('site_title'){{ $subTitle }}@endsection
    @section('description'){{ $subDesc }}@endsection
    @section('og_url'){{ $subUrl }}@endsection
    @section('og_title'){{ $subTitle }}@endsection
    @section('og_description'){{ $subDesc }}@endsection
    @section('og_image'){{ asset('frontend/images/web-journey-your-web-tutor.png') }}@endsection
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

            <x-frontend.dynamic-breadcrumb :title="__('Subcategory: ').$subcategory->name" />
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
