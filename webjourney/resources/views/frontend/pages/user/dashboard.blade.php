@extends('frontend.layouts.master')

@section('site_title','Dashboard - WebJourney')

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
            <section class="middle-padding">
                <div class="container">
                    <!--dasboard-wrap-->
                    <div class="dasboard-wrap fl-wrap">
                        <!-- dashboard-content-->
                        <div class="dashboard-content fl-wrap">
                            <!-- dashboard-list-box-->
                            <div class="dashboard-list-box fl-wrap activities">
                                <div class="dashboard-header fl-wrap">
                                    <h3>{{ __('Your Courses') }}</h3>
                                </div>
                                <!-- dashboard-list-->
                                <div class="dashboard-list">
                                    <div class="dashboard-message">
                                        <span class="new-dashboard-item"><i class="fal fa-eye"></i></span>
                                        <div class="dashboard-message-text">
                                            <p><i class="far fa-check"></i><a href="javascript:void(0)">Your all courses here</a></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- dashboard-list end-->
                                <!-- dashboard-list-->
                                <div class="dashboard-list">
                                    <div class="dashboard-message">
                                        <span class="new-dashboard-item"><i class="fal fa-eye"></i></span>
                                        <div class="dashboard-message-text">
                                            <p><i class="far fa-check"></i><a href="javascript:void(0)">You can watch your courses here</a></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- dashboard-list end-->
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

