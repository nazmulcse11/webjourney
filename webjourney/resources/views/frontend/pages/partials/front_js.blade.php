<script>
    $(document).ready(function(){

        //register
        $('.user_register_btn').on('click',function(e){
            e.stopImmediatePropagation();

            let name = $('#name').val();
            let email = $('#l_email').val();
            let password = $('#l_password').val();

            if(name != '' || email != '' || password != '') {
                $('.emailSending').html('<p style="color:red;text-align: left;">' + 'Please wait email is sending....' + '</p>');
            }else{
                toastr_warning('Please fill all fields');
            }
        })

        //login
        $(document).on('click','#login_form_submit',function (e){
            e.preventDefault();
            let email = $('#l_email').val();
            let password = $('#l_password').val();
            let remember = $('#remember').val();
            let el = $(this);
            el.text('{{__('Please Wait..')}}');

            $.ajax({
                url: "{{route('user.login')}}",
                type: "POST",
                data: {
                    email:email,
                    password:password,
                    remember:remember,
                },
                error:function(data){
                    let errors = data.responseJSON;
                    $.each(errors.errors, function(index,value){
                        $('.loginErrMsgContainer').append('<p style="color:red;text-align:left">'+value+'</p>');
                    });
                    el.text('{{__('Login')}}');
                },
                success:function (data){
                    if (data.status == 'login'){
                        el.text('{{__('Redirecting')}}..');
                        $('.loginErrMsgContainer').html('<div style="color:green;text-align:left" class="alert alert-'+data.type+'">'+data.msg+'</div>');
                        window.location = "{{route('user.dashboard')}}";
                    }else{
                        $('.loginErrMsgContainer').html('<p style="color:red;text-align:left">'+data.msg+'</p>');
                        el.text('{{__('Login')}}');
                    }
                }
            });
        });

        // lost password
        $(document).on('click','#lost_password',function(){
            $('#tab-1,#tab-2').hide();
            $('.lostPasswordFormWrapper').css("display","block");
        });

        //get new password
        $(document).on('click','#lost_password_form_submit',function(e){
            e.preventDefault();
            let email = $('#lost_password_email').val();
            if(email == ''){
                $('.errMsgContainer').html('<p style="color:red;text-align: left;">' + 'Please enter your email.' + '</p>');
                return false;
            }
            $.ajax({
                url:'{{ route("user.get.lost.password") }}',
                method:'post',
                data:{email:email},
                beforeSend: function() {
                    $('.emailSending').html('<p style="color:red;text-align: left;">' + 'Please wait email is sending....'+ '</p>');
                    $('.errMsgContainer').html('');
                },
                success:function(res){
                    $('.errMsgContainer').html(res.msg);
                    $('.emailSending').html('');
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $('.errMsgContainer').html('<p style="color:red;text-align: left;">'+value+'</p>'+'<br>');
                    });
                }
            });
        });


        //like post
        $(document).on('click','.like-post',function(e){
            e.stopImmediatePropagation();
            let post_id = $(this).data('post_id');
            let post_like_count = '.post_like_count_' + post_id;
            let like_unlike = '.like_unlike' + post_id;
            $.ajax({
                url:"{{ route('post.like') }}",
                method:'post',
                data:{post_id:post_id},
                success:function(res){
                    if(res.status == 'liked'){
                        $(post_like_count).text(res.total_like_count);
                        $(post_like_count).slideUp(1000);
                        $(post_like_count).slideDown(1000);
                        $('li'+like_unlike+ ' a i').addClass('like-color');
                    }
                    if(res.status == 'unliked'){
                        $(post_like_count).text(res.total_like_count);
                        $('li'+like_unlike+ ' a i').removeClass('like-color');
                    }
                },error(err){
                    toastr_info('Please login to add a like.');
                }
            });
        })


        //favourite post
        $(document).on('click','.favourite-post',function(e){
            e.stopImmediatePropagation();
            let post_id = $(this).data('post_id');
            let post_favourite_count = '.post_favourite_count_' + post_id;
            let favourite_unfavourite = '.favourite_unfavourite' + post_id;
            $.ajax({
                url:"{{ route('add.to.favourite') }}",
                method:'post',
                data:{post_id:post_id},
                success:function(res){
                    if(res.status == 'add'){
                        $(post_favourite_count).text(res.total_favourite_count);
                        $('.favourite_counter').text(res.total_favourite_count_single_user);
                        $('.wishlist-content').load(location.href + ' .wishlist-content');
                        $(post_favourite_count).slideUp(1000);
                        $(post_favourite_count).slideDown(1000);
                        $('li'+favourite_unfavourite+ ' a i').addClass('like-color');
                        toastr_success('Successfully added to your favourite list');
                    }
                    if(res.status == 'remove'){
                        $(post_favourite_count).text(res.total_favourite_count);
                        $('.favourite_counter').text(res.total_favourite_count_single_user);
                        $('li'+favourite_unfavourite+ ' a i').removeClass('like-color');
                        $('.wishlist-content').load(location.href + ' .wishlist-content');
                        toastr_info('Successfully remove from your favourite list');
                    }
                },error(err){
                    toastr_info('Please login to add a post in your favourite list');
                }
            });
        })

        // remove-favourite-post from user dashboard
        $(document).on('click','.remove-favourite-post',function(e){
            e.stopImmediatePropagation();
            let post_id = $(this).data('post_id');
            $.ajax({
                url:"{{ route('remove.from.favourite') }}",
                method:'post',
                data:{post_id:post_id},
                success:function(res){
                    if(res.status == 'remove'){
                        toastr_info('Successfully remove from your favourite list');
                        $('.user-favourite-post-area').load(location.href + ' .user-favourite-post-area');
                    }
                },error(err){
                    toastr_error('Something went wrong');
                }
            });
        })

    });  //jquery document end

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
    function toastr_info(msg){
        Command: toastr["info"](msg, "Info")
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

    function toastr_warning(msg){
        Command: toastr["warning"](msg, "Warning")
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
