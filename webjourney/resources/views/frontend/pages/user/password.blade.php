@extends('frontend.layouts.master')

@section('site_title','Password Change - WebJourney')

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
                                <h3>{{ __('Change Password') }}</h3>
                            </div>
                            <form action="{{ route('user.password') }}" method="post" id="password_update_frm">
                                @csrf
                                <div class="custom-form no-icons">
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>{{ __('Current Password') }}</label>
                                        <input type="password" class="pass-input" id="current_password" placeholder="{{ __('Enter current password') }}" value=""/>
                                        <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                    </div>
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>{{ __('New Password') }}</label>
                                        <input type="password" class="pass-input" id="new_password" placeholder="{{ 'Enter new password' }}" value=""/>
                                        <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                    </div>
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>{{ __('Confirm New Password') }}</label>
                                        <input type="password" class="pass-input" id="confirm_password" placeholder="{{ __('Confirm new password') }}" value=""/>
                                        <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                    </div>
                                    <button class="btn  big-btn  color2-bg flat-btn float-btn update-user-password">{{ __('Save Changes') }}<i class="fal fa-save"></i></button>
                                </div>
                            </form>
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
            $(document).on('click','.update-user-password',function(e){
                e.preventDefault();
                let current_password = $('#current_password').val();
                let new_password = $('#new_password').val();
                let confirm_password = $('#confirm_password').val();

                $.ajax({
                    url:"{{ route('user.password') }}",
                    method:'post',
                    data:{current_password:current_password,new_password:new_password,confirm_password:confirm_password},
                    success:function(res){
                        if(res.status == 'success'){
                            toastr_success('Password updated success');
                            $('#password_update_frm')[0].reset();
                        }
                        if(res.status == 'wrong'){
                            toastr_error('Current password is wrong');
                        }
                        if(res.status == 'not_match'){
                            toastr_error('Password and confirm password not match');
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

