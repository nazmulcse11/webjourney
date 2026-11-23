@extends('frontend.layouts.master')

@section('site_title','WebJourney - PHP, Laravel, MySql, Javascript, Jquery, Vue Js Tutorial')
@section('keywords',get_static_option('keywords'))
@section('description',get_static_option('description'))
@section('og_url',route('homepage'))
@section('og_title','Webjourney')
@section('og_description','PHP, Laravel, MySql, Javascript, Jquery, Vue Js Tutorial')

@section('css')
    <style>
       li.page-item.active {background: #F9B90F;color: white}
      .page-item:first-child .page-link,
      .page-item:last-child .page-link{border-top-left-radius: 0.25rem;border-bottom-left-radius: 0.25rem;width: 44px;height: 44px;line-height: 44px;display: inline;padding-top: 15px;border-radius: 5px;background: none;border: 0}
      .page-link:hover {color: unset}
      .fa-calendar{color:#F9B90F}
    </style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">

            <x-frontend.breadcrumb />
            <!-- section-->
            <section id="sec1" class="middle-padding grey-blue-bg">
                <div class="container">
                    <div class="row">
                        @include('frontend.pages.partials.post_markup')
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

@section('scripts')
    <script>
        $(document).ready(function () {
            if (window.location.search.indexOf('page=') !== -1 && window.history && window.history.replaceState) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }

            $(document).on('click', '#home-post-container .pagination a', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                if (!href || href === '#') {
                    return;
                }
                var pageMatch = href.match(/[?&]page=(\d+)/);
                var page = pageMatch ? pageMatch[1] : 1;

                $.ajax({
                    url: "{{ route('homepage') }}?page=" + page,
                    method: 'GET',
                    beforeSend: function () {
                        $('#home-post-container').css('opacity', '0.5');
                    },
                    success: function (res) {
                        $('#home-post-container').replaceWith(res);
                        $('html, body').stop().animate({
                            scrollTop: 0
                        }, 350);
                    }
                });
            });
        });
    </script>
@endsection

