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
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
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
        .post-grid-container {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: stretch !important;
        }
        .post-grid-container > .article-masonry {
            height: auto !important;
            display: flex !important;
            float: none !important;
            margin-bottom: 24px !important;
        }
        .post-grid-container > .article-masonry > .card-post {
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            float: none !important;
        }
        .post-grid-container > .article-masonry .card-post-content {
            flex: 1 1 auto !important;
            display: flex !important;
            flex-direction: column !important;
            float: none !important;
            width: 100% !important;
        }
        .post-grid-container > .article-masonry .card-post-content .post-author {
            margin-top: auto !important;
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
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/prism.css') }}">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('common/css/toastr.min.css') }}">

    {{-- jquery--}}
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    
    
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
<!--loader-->
<div class="loader-wrap">
    <div class="pin">
        <div class="pulse"></div>
    </div>
</div>
<!--loader end-->
<!-- Main  -->
<div id="main">
    @include('frontend.layouts.partials.header')
    @yield('content')
    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials.login_register_modal')
    <a class="to-top"><i class="fas fa-caret-up"></i></a>
</div>
<!-- Main end -->
<!--=============== scripts  ===============-->
<script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/prism.js') }}"></script>
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
