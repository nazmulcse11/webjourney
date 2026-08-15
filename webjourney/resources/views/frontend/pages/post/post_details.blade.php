@extends('frontend.layouts.master')
    @section('site_title'){{ $post_details->title }}@endsection
    @section('description'){{ $post_details->meta_description }}@endsection
    @section('og_url'){{ route('post.details',$post_details->slug) }}@endsection
    @section('og_title'){{ $post_details->title }}@endsection
    @section('og_description'){{ $post_details->meta_description }}@endsection
    @section('og_image'){{asset('images/post/'.$post_details->image)}}@endsection
    
    @section('css')
        <style>
        /* Missing Font Awesome 5 Brands Icons */
        .fa-whatsapp:before { content: "\f232" !important; }
        .fa-reddit:before { content: "\f1a1" !important; }
        .fa-reddit-alien:before { content: "\f281" !important; }
        .fa-linkedin-in:before { content: "\f0e1" !important; }

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
        .tags-stylwrap-for-random-post a {
            float: left;
            padding: 10px 18px;
            border-radius: 6px;
            color: #1f2027;
            font-size: 15px;
            background: #f8fafc;
            border: 1px solid #eef2f6;
            font-weight: 600;
            margin-right: 10px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            display: inline-flex;
            align-items: center;
        }
        .tags-stylwrap-for-random-post a:hover {
            background: #183c7d;
            color: #fff;
            border-color: #183c7d;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(24, 60, 125, 0.15);
        }
        .tags-stylwrap-for-random-post a .icon-hover-interact {
            margin-left: 8px;
            font-size: 13px;
            opacity: 0;
            width: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .tags-stylwrap-for-random-post a:hover .icon-hover-interact {
            opacity: 1;
            width: auto;
            transform: translateX(0);
        }
        /* Post Content Typography & Alignment Reset */
        .post-description-content { 
            text-align: left !important; 
            color: #1f2027;
            font-size: 15px;
            line-height: 1.7;
        }
        .post-description-content * { 
            box-sizing: border-box;
        }
        .post-description-content h1, 
        .post-description-content h2, 
        .post-description-content h3, 
        .post-description-content h4, 
        .post-description-content h5, 
        .post-description-content h6 {
            text-align: left !important;
            color: #183c7d;
            font-weight: 700;
            margin-top: 24px !important;
            margin-bottom: 12px !important;
            clear: both !important;
            float: none !important;
            display: block !important;
            width: 100% !important;
        }
        /* Main Post Title Typography */
        .description_heading_title {
            padding-top: 5px !important;
            padding-bottom: 10px !important;
            margin-bottom: 15px !important;
        }
        .description_heading_title h1 {
            font-size: 28px !important;
            font-weight: 700 !important;
            color: #183c7d !important;
            line-height: 1.35 !important;
            margin-top: 0 !important;
            margin-bottom: 0px !important;
            text-align: left !important;
        }
        /* Reduce the large empty gap above the post when there is no image */
        .post-article .list-single-main-item:first-of-type {
            padding-top: 10px !important;
        }

        .post-description-content h1 { font-size: 24px !important; }
        .post-description-content h2 { font-size: 21px !important; }
        .post-description-content h3 { font-size: 18px !important; font-weight: 600 !important; }
        .post-description-content h4 { font-size: 16px !important; font-weight: 600 !important; }
        .post-description-content h5 { font-size: 15px !important; }
        .post-description-content h6 { font-size: 14px !important; }

        .post-description-content p { 
            text-align: left !important; 
            margin-bottom: 15px !important;
            line-height: 1.7 !important;
            clear: both !important;
            float: none !important;
            width: 100% !important;
        }

        .post-description-content ul { 
            list-style-type: disc !important; 
            margin: 15px 0 15px 30px !important; 
            padding-left: 0 !important; 
            text-align: left !important;
            display: block !important;
            clear: both !important;
        }
        .post-description-content ol { 
            list-style-type: decimal !important; 
            margin: 15px 0 15px 30px !important; 
            padding-left: 0 !important; 
            text-align: left !important;
            display: block !important;
            clear: both !important;
        }
        .post-description-content li { 
            display: list-item !important; 
            list-style: inherit !important;
            margin-bottom: 8px !important; 
            color: #1f2027 !important; 
            float: none !important; 
            width: auto !important; 
            text-align: left !important;
            padding-left: 5px !important;
        }

        .post-description-content pre {
            background: #1e1e1e !important;
            color: #d4d4d4 !important;
            padding: 16px 20px !important;
            border-radius: 6px !important;
            overflow-x: auto !important;
            font-family: 'Fira Code', Consolas, Monaco, 'Courier New', monospace !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
            margin: 18px 0 !important;
            text-align: left !important;
            display: block !important;
            border: 1px solid #333333 !important;
            clear: both !important;
            -webkit-text-stroke: 0 !important;
            text-shadow: none !important;
            font-weight: 400 !important;
            letter-spacing: normal !important;
        }
        .post-description-content pre * {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            font-weight: 400 !important;
            -webkit-text-stroke: 0 !important;
            text-shadow: none !important;
            letter-spacing: normal !important;
            font-family: inherit !important;
        }
        .post-description-content pre:empty {
            display: none !important;
        }
        .post-description-content :not(pre) > code {
            font-family: 'Fira Code', Consolas, Monaco, 'Courier New', monospace !important;
            font-size: 13px !important;
            background: #f1f3f5 !important;
            color: #d63384 !important;
            padding: 2px 6px !important;
            border-radius: 4px !important;
            font-weight: 500 !important;
            -webkit-text-stroke: 0 !important;
            text-shadow: none !important;
        }
        .post-description-content h1 code,
        .post-description-content h2 code,
        .post-description-content h3 code,
        .post-description-content h4 code,
        .post-description-content h5 code,
        .post-description-content h6 code {
            font-size: inherit !important;
            color: inherit !important;
            font-weight: inherit !important;
        }
        .post-description-content pre code {
            background: transparent !important;
            color: inherit !important;
            padding: 0 !important;
            border-radius: 0 !important;
            display: inline !important;
        }
        .post-description-content blockquote { 
            border-left: 4px solid #5ECFB1 !important; 
            padding: 12px 20px !important; 
            margin: 20px 0 !important; 
            background: #f8fafc !important; 
            font-style: italic !important; 
            text-align: left !important; 
            clear: both !important;
        }
</style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">

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
                                    <div class="post-description-content">
                                        {!! $post_details->description !!}
                                    </div>
                                    <div class="post-opt">
                                        <ul>
                                            <li>
                                                <i class="fal fa-calendar"></i> 
                                                <span>
                                                    @if($post_details->updated_at && $post_details->created_at && $post_details->created_at->format('Y-m-d') !== $post_details->updated_at->format('Y-m-d'))
                                                        Updated: {{ $post_details->updated_at->toFormattedDateString() }}
                                                    @elseif($post_details->created_at)
                                                        {{ $post_details->created_at->toFormattedDateString() }}
                                                    @endif
                                                </span>
                                            </li>
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
                                            <h3>{{ __('You May Also Like Below Articles:') }}</h3>
                                        </div>
                                        <div class="reviews-comments-wrap">
                                            @foreach($random_posts as $post)
                                                <div class="list-single-tags tags-stylwrap-for-random-post blog-tags">
                                                     <a href="{{ route('post.details',$post->slug) }}">
                                                         <i class="fal fa-file-alt" style="margin-right:8px; opacity:0.7;"></i> 
                                                         {{ $post->title }}
                                                         <i class="fas fa-arrow-right icon-hover-interact"></i>
                                                     </a>
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

