@extends('frontend.layouts.master')

@section('site_title','Profile Update - WebJourney')

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
                            <div class="box-widget-item-header">
                                <h3>{{ __('Your Profile') }}</h3>
                            </div>
                            <!-- profile-edit-container-->
                            <div class="profile-edit-container">
                                <form action="{{ route('user.profile') }}" method="post">
                                    @csrf
                                    <div class="custom-form">
                                        <label>{{ __('Your Name') }} <i class="far fa-user"></i></label>
                                        <input type="text" placeholder="{{ __('Nazmul Hoque') }}" id="user_name" name="user_name" value="{{ Auth::guard('web')->user()->name }}"/>
                                        <label>{{ __('Email Address') }}<i class="far fa-envelope"></i>  </label>
                                        <input type="email" placeholder="{{ __('nazmul@domain.com') }}" value="{{ Auth::guard('web')->user()->email }}" disabled="disabled" />
                                        <label>{{ __('Phone') }}<i class="far fa-phone"></i>  </label>
                                        <input type="text" placeholder="+88017190---" id="user_phone" name="user_phone" value="{{ Auth::guard('web')->user()->phone }}"/>
                                        <button class="btn color2-bg float-btn update-user-profile">{{ __('Save Changes') }}<i class="fal fa-save"></i></button>
                                    </div>
                                </form>
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

@section('scripts')
    <script>
        $(document).ready(function(e){
            $(document).on('click','.update-user-profile',function(e){
                e.preventDefault();
                let name = $('#user_name').val();
                let phone = $('#user_phone').val();

                $.ajax({
                    url:"{{ route('user.profile') }}",
                    method:'post',
                    data:{name:name,phone:phone},
                    success:function(res){
                        if(res.status == 'success'){
                            toastr_success('Profile Update Success');
                        }
                    },error:function(err){
                        toastr_error('Something Went Wrong');
                    }
                });
            });
        });


        function toastr_success(msg){
            Command: toastr["success"](msg, "Success")
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
        function toastr_error(msg){
            Command: toastr["error"](msg, "Error")
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    </script>
@endsection

