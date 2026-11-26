<!DOCTYPE HTML>
<html lang="en">
<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    @php
        $currentURL = URL::current();
        $site_url = url('/');
        $canonicalUrl = (request()->filled('page') && (int) request('page') > 1)
            ? $currentURL . '?page=' . (int) request('page')
            : $currentURL;
        $defaultDescription = get_static_option('description') ?: 'WebJourney provides practical PHP, Laravel, MySQL, JavaScript, jQuery, Vue.js, React, and Web Development tutorials and interactive quizzes.';
        $defaultOgImage = asset('frontend/images/web-journey-your-web-tutor.png');
    @endphp
    <title>@yield('site_title', 'WebJourney - PHP, Laravel, MySQL, JavaScript & Web Development Tutorials')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')"/>
    <link rel="canonical" href="@yield('canonical', $canonicalUrl)" />
    @if($currentURL == $site_url)<meta name="keywords" content="@yield('keywords')"/>@endif
    <meta name="description" content="@yield('description', $defaultDescription)"/>
    <meta property="og:site_name" content="WebJourney">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', $canonicalUrl)">
    <meta property="og:title" content="@yield('og_title', 'WebJourney')">
    <meta property="og:description" content="@yield('og_description', $defaultDescription)">
    <meta property="og:image" content="@yield('og_image', $defaultOgImage)">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'WebJourney')">
    <meta name="twitter:description" content="@yield('og_description', $defaultDescription)">
    <meta name="twitter:image" content="@yield('og_image', $defaultOgImage)">
    <link rel="alternate" type="application/rss+xml" title="WebJourney RSS Feed" href="{{ route('rss.feed') }}" />
    @yield('meta_extra')
    @if($currentURL == $site_url)
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => $site_url . '/#organization',
                'name' => 'WebJourney',
                'url' => $site_url,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $defaultOgImage,
                ],
                'sameAs' => array_values(array_filter([
                    'https://www.facebook.com/WebJourneybd',
                    'https://www.youtube.com/c/WebJourneybd',
                    'https://stackoverflow.com/users/12187513/nazmul-hoque',
                    get_static_option('github'),
                    get_static_option('linkedin'),
                ])),
            ],
            [
                '@type' => 'WebSite',
                '@id' => $site_url . '/#website',
                'url' => $site_url,
                'name' => 'WebJourney',
                'description' => $defaultDescription,
                'publisher' => ['@id' => $site_url . '/#organization'],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => $site_url . '/search/label/search-string?search_string={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endif
    @yield('schema')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--=============== preconnects & fonts ===============-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://pagead2.googlesyndication.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap"></noscript>

    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
        /* Instant Paint (Eliminate render-blocking full-screen loader delay for FCP & LCP) */
        .loader-wrap { display: none !important; }
        #main { opacity: 1 !important; }
        .card-post-img img { aspect-ratio: 16 / 9; width: 100%; height: auto; display: block; }
        li.page-item.active .page-link, li.page-item.active { background: #183c7d !important; color: #ffffff !important; border-color: #183c7d !important; }

        /* Missing Font Awesome 5 Brands Icons */
        .fa-whatsapp:before { content: "\f232" !important; }
        .fa-reddit:before { content: "\f1a1" !important; }
        .fa-reddit-alien:before { content: "\f281" !important; }
        .fa-linkedin-in:before { content: "\f0e1" !important; }

        .card-post-content h2 {
            float: left;
            width: 100%;
            text-align: left;
            font-size: 21px !important;
            font-weight: 700 !important;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
            position: relative;
            line-height: 1.4;
        }
        .card-post-content h2:before {
            display: none !important;
        }
        .card-post-content h2 a {
            color: #183c7d !important;
            transition: color 0.2s ease;
        }
        .card-post-content h2 a:hover {
            color: #5ECFB1 !important;
        }
        /* Unified & Modern Sidebar Widgets */
        .box-widget-item {
            margin-bottom: 24px !important;
        }
        .box-widget {
            background: #ffffff !important;
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04) !important;
            overflow: hidden !important;
        }
        .box-widget-content {
            padding: 10px 20px 10px !important;
            box-sizing: border-box !important;
        }
        .box-widget-item-header {
            padding: 5px 0 8px 0 !important;
            margin: 0 !important;
            border-bottom: 1.5px solid #e2e8f0 !important;
            float: left !important;
            width: 100% !important;
            text-align: left !important;
        }
        .box-widget-item-header:before,
        .box-widget-item-header:after {
            display: none !important;
            content: none !important;
        }
        .box-widget-item-header h3 {
            font-size: 17px !important;
            font-weight: 800 !important;
            color: #183c7d !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.25 !important;
            text-align: left !important;
            float: none !important;
        }
        /* Popular Posts List */
        .box-image-widget {
            float: left !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 9px 0 !important;
            border-bottom: 1px solid #f1f5f9 !important;
            text-align: left !important;
            box-sizing: border-box !important;
        }
        .box-image-widget:last-child {
            border-bottom: none !important;
            padding-bottom: 4px !important;
            margin-bottom: 0 !important;
        }
        .box-image-widget a {
            display: flex !important;
            align-items: flex-start !important;
            gap: 8px !important;
            width: 100% !important;
            text-align: left !important;
            text-decoration: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .box-image-widget a .wj-sb-arrow {
            flex-shrink: 0 !important;
            margin-top: 4px !important;
            color: #94a3b8 !important;
            transition: color 0.15s ease, transform 0.15s ease !important;
        }
        .box-image-widget a:hover .wj-sb-arrow {
            color: #F9B90F !important;
            transform: translateX(2px) !important;
        }
        .box-image-widget h4 {
            flex: 1 1 auto !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 13.5px !important;
            font-weight: 600 !important;
            color: #334155 !important;
            line-height: 1.45 !important;
            text-align: left !important;
            text-indent: 0 !important;
            transition: color 0.15s ease !important;
        }
        .box-image-widget h4 i {
            display: none !important;
        }
        .box-image-widget a:hover h4 {
            color: #183c7d !important;
        }
        /* Categories & Quizzes Sidebar List */
        .cat-item {
            float: left !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }
        .cat-item li {
            float: none !important;
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 10px !important;
            padding: 9px 0 !important;
            margin: 0 !important;
            border-bottom: 1px solid #f1f5f9 !important;
            text-align: left !important;
            box-sizing: border-box !important;
        }
        .cat-item li:last-child {
            border-bottom: none !important;
            padding-bottom: 4px !important;
            margin-bottom: 0 !important;
        }
        .cat-item li:before,
        .cat-item li:after {
            display: none !important;
            content: none !important;
        }
        .cat-item li a {
            float: none !important;
            flex: 1 1 auto !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #334155 !important;
            line-height: 1.4 !important;
            text-align: left !important;
            margin: 0 !important;
            padding: 0 !important;
            transition: color 0.15s ease !important;
        }
        .cat-item li a:hover {
            color: #183c7d !important;
        }
        .cat-item li span {
            float: none !important;
            flex-shrink: 0 !important;
            background: #f1f5f9 !important;
            color: #475569 !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            padding: 2px 9px !important;
            border-radius: 999px !important;
            line-height: 1.4 !important;
        }
        .post-grid-container {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: flex-start !important;
        }
        .post-grid-container > .article-masonry {
            height: auto !important;
            float: none !important;
            margin-bottom: 24px !important;
        }
        .post-grid-container > .pagination-wrapper {
            width: 100% !important;
            flex: 0 0 100% !important;
            clear: both !important;
            float: left !important;
            margin-top: 20px !important;
            padding-top: 10px !important;
        }
        .post-grid-container .pagination {
            margin-top: 0 !important;
            float: none !important;
            display: flex !important;
            justify-content: center !important;
            flex-wrap: wrap !important;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/prism.css') }}" media="print" onload="this.media='all'">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('common/css/toastr.min.css') }}" media="print" onload="this.media='all'">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DWJHK66HKL"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-DWJHK66HKL');
    </script>

     <!-- Google ads) -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8673885649672159"
     crossorigin="anonymous"></script>

    @yield('css')

</head>
<body>
<!-- Main  -->
<div id="main">
    @include('frontend.layouts.partials.header')
    @yield('content')
    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials.login_register_modal')
    <a href="#main" class="to-top" aria-label="Back to top"><i class="fas fa-caret-up"></i></a>
</div>
<!-- Main end -->
<!--=============== scripts  ===============-->
<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/prism.js') }}" defer></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>

@include('frontend/pages/partials/front_js')

<script>
    $(document).ready(function(){
        $(document).on('keyup','#header_search',function(e){
            e.preventDefault();
            $('#header_search_result').css('display','block');
            let search_string = $('#header_search').val();

            if(search_string != ''){
                $.ajax({
                    url:"{{ route('header.live.search') }}",
                    method:'GET',
                    data:{search_string:search_string},
                    success:function(res){
                        $('#header_search_result').html(res.search_result);
                    }
                });
            }else{
                $('#header_search_result').html('');
            }

        });
    });
</script>

{{--//toastr js--}}
<script src="{{ asset('common/js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
@yield('scripts')
</body>
</html>
