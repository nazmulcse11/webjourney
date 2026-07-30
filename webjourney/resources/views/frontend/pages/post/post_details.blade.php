@extends('frontend.layouts.master')
    @section('site_title'){{ $post_details->title }}@endsection
    @section('description'){{ $post_details->meta_description }}@endsection
    @section('og_url'){{ route('post.details',$post_details->slug) }}@endsection
    @section('og_title'){{ $post_details->title }}@endsection
    @section('og_description'){{ $post_details->meta_description }}@endsection
    @section('og_image'){{asset('images/post/'.$post_details->image)}}@endsection
    
    @section('css')
        <style>
        table {
            border: 1px solid #d9d7ce;
            display: inline-block;
            vertical-align: top;
            max-width: 100%;
            overflow-x: auto;
            border-collapse: collapse;
            border-spacing: 0;
        }
        
        table,
        table tbody {
          -webkit-overflow-scrolling: touch;
        }
        
        table th {
          font-size: 11px;
          text-transform: uppercase;
          background: #f2f0e6;
        }
        
        table th, table td {
    	  text-align: left;
    	  padding: 6px 5px;
    	  border: 1px solid #d9d7ce;
    	  font-size: 14px;
        }
        .list-single-main-item-title-for-random-post{border-bottom: 1px solid #eee;}
        .list-single-main-item-title-for-random-post h3{font-size:20px;}
        .tags-stylwrap-for-random-post  a {
    float: left;
    padding: 5px 10px;
    border-radius: 2px;
    color: #1f2027;
    font-size: 16px;
    background: #ECF6F8;
    font-weight: 500;
    margin-right: 6px;
    margin-bottom: 15px;
}
</style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
             <!--Horizontal ads -->
            <section class="middle-padding ">
                <div class="container">
                    <div class="flat-title-wrap">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8673885649672159" crossorigin="anonymous"></script>
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8673885649672159"
                             data-ad-slot="1123428994"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </section>
            <!--  ads  end-->
        <!-- section-->
        <section  id="sec1" class="middle-padding grey-blue-bg">
            <div class="container">
                <div class="row">
                    <!--blog content -->
                    <div class="col-md-8">
                        <!--post-container -->
                        <div class="post-container fl-wrap">
                            <!-- article> -->
                            <article class="post-article">
                                @if($post_details->image!=NULL)
                                <div class="list-single-main-media fl-wrap">
                                    <div class="single-slider-wrapper fl-wrap">
                                        <div class="single-slider fl-wrap">
                                            <div class="slick-slide-item"><img src="{{ asset('images/post/'.$post_details->image) }}" alt="{{ $post_details->title }}"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="list-single-main-item fl-wrap">
                                    <div class="list-single-main-item-title description_heading_title fl-wrap">
                                        <h1>{{ $post_details->title }}</h1>
                                    </div>
                                    {!! $post_details->description !!}
                                    <div class="post-opt">
                                        <ul>
                                            <li><i class="fal fa-calendar"></i> <span>{{ $post_details->created_at->toFormattedDateString() }}</span></li>
                                            <li><a href="{{ route('post.details',$post_details->slug) }}"><i class="fal fa-eye"></i> <span>{{ $post_details->view }}</span></a></li>
                                            <li data-post_id="{{ $post_details->id }}" class="like-post like_unlike{{ $post_details->id }}">
                                                <a href="javascript:void(0)">
                                                    @php $user_like_count =0 @endphp
                                                    @if(Auth::guard('web')->check())
                                                        @foreach ($post_details->post_like as $like)
                                                            @if($like->user_id == Auth::guard('web')->user()->id)
                                                                @php $user_like_count=1 @endphp
                                                                <i class="fal fa-thumbs-up" style="color:red!important"></i>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if($user_like_count == 0) <i class="fal fa-thumbs-up"></i> @endif
                                                    <span class="post_like_count_{{$post_details->id}}">{{ optional($post_details->post_like)->count() }}</span>
                                                </a>
                                            </li>
                                            <li data-post_id="{{ $post_details->id }}" class="favourite-post favourite_unfavourite{{ $post_details->id }}">
                                                <a href="javascript:void(0)">
                                                    @php $user_fav_count=0 @endphp
                                                    @if(Auth::guard('web')->check())
                                                        @foreach ($post_details->post_favourite as $fav)
                                                            @if($fav->user_id == Auth::guard('web')->user()->id)
                                                                @php $user_fav_count=1 @endphp
                                                                <i class="fal fa-heart" style="color:red!important"></i>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if($user_fav_count == 0) <i class="fal fa-heart"></i> @endif
                                                    <span class="post_favourite_count_{{$post_details->id}}">{{ optional($post_details->post_favourite)->count() }}</span>
                                                </a>
                                            </li>
                                            <li><i class="fal fa-comment"></i> <span>{{ optional($post_details->comments)->count() }}</span></li>
                                        </ul>
                                    </div>
                                    <span class="fw-separator"></span>
                                    <div class="list-single-main-item-title fl-wrap">
                                        <h3>{{ __('Tags') }}</h3>
                                    </div>
                                    <div class="list-single-tags tags-stylwrap blog-tags">
                                        @foreach($post_details->tags as $tag)
                                            <a href="{{ route('tag.tutorial',$tag->slug) }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>

                                    <span class="fw-separator"></span>
                                        <div class="box-widget-item fl-wrap">
                                            <div class="list-widget-social">
                                                <ul>
                                                    <li><p>{{ __('Share This:') }}</p></li>
                                                  @php  $post_img = !empty($post_details) ? $post_details['img_url'] : '';@endphp
                                                    {!! single_post_share(route('post.details',['id'=>$post_details->id, 'slug'=>$post_details->slug]),$post_details->title,$post_img) !!}
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                                
                                <!-- random post start-->
                                    <div class="list-single-main-item fl-wrap" id="sec5">
                                        @if($post_details)
                                        <div class="list-single-main-item-title-for-random-post fl-wrap">
                                            <h3>{{ __('You May Also Like Bellow Articles:') }}</h3>
                                        </div>
                                        <div class="reviews-comments-wrap">
                                            @foreach($random_posts as $post)
                                                <div class="list-single-tags tags-stylwrap-for-random-post blog-tags">
                                                     <a href="{{ route('post.details',$post->slug) }}">{{ $post->title }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                <!-- random post end -->

                                <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec5">
                                        @if($post_details->comments->count() >= 1)
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>{{ __('Comments') }} -  <span> {{ $post_details->comments->count() }} </span></h3>
                                        </div>
                                        @endif
                                        <!-- list-single-main-item -->
                                        @include('frontend.pages.post.partials.comment_box')
                                        <!-- list-single-main-item end -->
                                        <div class="reviews-comments-wrap" style="width:100%">
                                            <!-- reviews-comments-item -->
                                            @include('frontend.pages.post.partials.comments_display', ['comments' => $post_details->comments, 'post_id' => $post_details->id])
                                            <!--reviews-comments-item end-->
                                        </div>
                                    </div>
                                <!-- list-single-main-item end -->
                            </article>
                            <!-- article end -->
                        </div>
                        <!--post-container end -->
                    </div>
                    <!-- blog content end -->
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
        $(document).ready(function(e){

            $('.submit_your_comment').on('click' ,function(e){
                let comment = $('#comment_text').val();
                if(comment == ''){
                    $('.comment_error_message').html('<p style="color:red",float:left>'+'Please enter your review'+'</p>');
                    return false;
                }
            });
            $('#comment_text').on('keyup' ,function(e){
                let comment = $('#comment_text').val();
                if(comment == ''){
                    $('.comment_error_message').html('<p style="color:red",float:left>'+'Please enter your review'+'</p>');
                    return false;
                }else{
                    $('.comment_error_message').html(' ');
                }
            });

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

    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}","Error",)
    @endforeach

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
    </script>
@endsection

