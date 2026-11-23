@extends('frontend.layouts.master')
    @php
        $catTitle = $category->name . ' Tutorials, Guides & Code Examples - WebJourney';
        $catDesc = 'Learn ' . $category->name . ' with step-by-step tutorials, real-world code examples, troubleshooting guides, and best practices on WebJourney.';
        $catUrl = route('category.tutorial', $category->slug);
    @endphp
    @section('site_title'){{ $catTitle }}@endsection
    @section('description'){{ $catDesc }}@endsection
    @section('og_url'){{ $catUrl }}@endsection
    @section('og_title'){{ $catTitle }}@endsection
    @section('og_description'){{ $catDesc }}@endsection
    @section('og_image'){{ asset('frontend/images/web-journey-your-web-tutor.png') }}@endsection
    @section('schema')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => route('homepage'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $category->name . ' Tutorials',
                'item' => $catUrl,
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endsection
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

            <x-frontend.dynamic-breadcrumb :title="__('Category: ').$category->name" />
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

