<!DOCTYPE HTML>
<html lang="en">
<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>@yield('site_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow"/>
    @php $currentURL = URL::current(); $site_url = url('/'); @endphp
    @if($currentURL == $site_url)<meta name="keywords" content="@yield('keywords')"/>@endif
    <meta name="description" content="@yield('description')"/>
    <meta property="og:url" content="@yield('og_url')">
    <meta property="og:title" content="@yield('og_title')">
    <meta property="og:description" content="@yield('og_description')">
    <meta property="og:image" content="@yield('og_image')">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
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
