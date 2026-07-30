<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Web Journey-Admin Login') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('homepage') }}"><b>{{ __('Web') }}</b>{{ __('Journey') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
            @if(session()->has('msg'))
                <div class="alert alert-{{session('type')}}">
                    {{ session('msg') }}
                </div>
            @endif
            <div class="error-message"></div>
            <form action="{{ route('admin.login') }}" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="form_submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">{{ __('Forgot Password') }}</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function ($){
        $(document).on('click','#form_submit',function (e){
            e.preventDefault();
            let email = $('#email').val();
            let password = $('#password').val();
            let remember = $('#remember').val();
            let el = $(this);
            let erContainer = $(".error-message");
            erContainer.html('');
            el.text('{{__('Please Wait..')}}');

            $.ajax({
                url: "{{route('admin.login')}}",
                type: "POST",
                data: {
                    email:email,
                    password:password,
                    remember:remember,
                },
                error:function(data){
                    let errors = data.responseJSON;
                    erContainer.html('<div class="alert alert-danger"></div>');
                    $.each(errors.errors, function(index,value){
                        erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                    });
                    el.text('{{__('Login')}}');
                },
                success:function (data){
                    console.log(data);
                    $('.alert.alert-danger').remove();
                    if (data.status == 'ok'){
                        el.text('{{__('Redirecting')}}..');
                        erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                        window.location = "{{route('admin.dashboard')}}";
                    }else{
                        erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                        el.text('{{__('Login')}}');
                    }
                }
            });
        });

    });

</script>

</body>
</html>
