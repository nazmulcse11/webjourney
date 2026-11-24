<!--blog content -->
<div class="col-md-8" id="home-post-container">
    <!--post-container -->
    <div class="post-container post-grid-container fl-wrap">
        @foreach($posts as $post)
            <!--article-masonry -->
            <div class="article-masonry">
                <article class="card-post">
                    <div class="card-post-img fl-wrap">
                        <a href="{{ route('post.details',$post->slug) }}">
                            <img src="{{ !empty($post->image) ? asset('images/post/'.$post->image) : asset('frontend/images/default-post-668x445.png') }}" onerror="this.onerror=null;this.src='{{ asset('frontend/images/web-journey-your-web-tutor.png') }}';" alt="{{ $post->title }}" loading="lazy">
                        </a>
                    </div>
                    <div class="card-post-content fl-wrap">
                        <h2><a href="{{ route('post.details',$post->slug) }}">{{ $post->title }}</a></h2>
                        <p>{{ Str::limit(!empty($post->meta_description) ? $post->meta_description : trim(preg_replace('/\s+/', ' ', strip_tags($post->description))), 160) }}</p>
                        <div class="post-author">
                            <a href="{{ route('post.details',$post->slug) }}">
                                <span>{{ __('Read More...')  }}</span>
                                <span> &nbsp;&nbsp; </span>
                                <span>
                                    <i class="fal fa-calendar"></i> 
                                    @if($post->updated_at && $post->created_at && $post->created_at->format('Y-m-d') !== $post->updated_at->format('Y-m-d'))
                                        Updated: {{ $post->updated_at->toFormattedDateString() }}
                                    @elseif($post->created_at)
                                        {{ $post->created_at->toFormattedDateString() }}
                                    @endif
                                </span>
                            </a>

                        </div>
                        <div class="post-opt">
                            <ul>
                                <li>
                                    <a href="{{ route('post.details',$post->slug) }}">
                                        <i class="fal fa-eye"></i>
                                        <span>{{ $post->view }}</span>
                                    </a>
                                </li>
                                <li data-post_id="{{ $post->id }}" class="like-post like_unlike{{ $post->id }}">
                                    <a href="javascript:void(0)">
                                        @php $user_like_count =0 @endphp
                                        @if(Auth::guard('web')->check())
                                            @foreach ($post->post_like as $like)
                                                @if($like->user_id == Auth::guard('web')->user()->id)
                                                    @php $user_like_count=1 @endphp
                                                    <i class="fal fa-thumbs-up" style="color:red !important;"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if($user_like_count == 0) <i class="fal fa-thumbs-up"></i> @endif
                                        <span class="post_like_count_{{$post->id}}">{{ optional($post->post_like)->count() }}</span>
                                    </a>
                                </li>
                                <li data-post_id="{{ $post->id }}" class="favourite-post favourite_unfavourite{{ $post->id }}">
                                    <a href="javascript:void(0)">
                                        @php $user_fav_count=0 @endphp
                                        @if(Auth::guard('web')->check())
                                            @foreach ($post->post_favourite as $fav)
                                                @if($fav->user_id == Auth::guard('web')->user()->id)
                                                    @php $user_fav_count=1 @endphp
                                                    <i class="fal fa-heart" style="color:red!important"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if($user_fav_count == 0) <i class="fal fa-heart"></i> @endif

                                        <span class="post_favourite_count_{{$post->id}}">{{ optional($post->post_favourite)->count() }}</span>
                                    </a>
                                </li>
                                <li><i class="fal fa-comment"></i> <span>{{ optional($post->comments)->count() }}</span></li>
                            </ul>
                        </div>
                        <div class="box-widget-item fl-wrap">
                            <div class="list-widget-social">
                                <ul>
                                    <li><p>{{ __('Share This:') }}</p></li>
                                    {!! single_post_share(route('post.details', $post->slug), $post->title, $post->image) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <!--article-masonry end -->
        @endforeach
        @if(method_exists($posts, 'links'))
            <div class="pagination-wrapper fl-wrap">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
    <!--post-container end -->
</div>
<!-- blog content end -->

