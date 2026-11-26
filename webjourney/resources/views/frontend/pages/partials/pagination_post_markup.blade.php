<!--blog content -->
<div class="col-md-8">
    <!--post-container -->
    <div class="post-container post-grid-container fl-wrap">
        @foreach($posts as $post)
            <!--article-masonry -->
            <div class="article-masonry">
                <article class="card-post">
                    <div class="card-post-img fl-wrap">
                        <a href="{{ route('post.details',$post->slug) }}" aria-label="{{ $post->title }}">
                            <img src="{{ !empty($post->image) ? asset('images/post/'.$post->image) : asset('frontend/images/default-post-668x445.png') }}" onerror="this.onerror=null;this.src='{{ asset('frontend/images/web-journey-your-web-tutor.png') }}';" alt="{{ $post->title }}" width="668" height="376" {!! $loop->index < 2 ? 'fetchpriority="high"' : 'loading="lazy"' !!}>
                        </a>
                    </div>
                    <div class="card-post-content fl-wrap">
                        <h2><a href="{{ route('post.details',$post->slug) }}">{{ $post->title }}</a></h2>
                        <p>{{ Str::limit(!empty($post->meta_description) ? $post->meta_description : trim(preg_replace('/\s+/', ' ', strip_tags($post->description))), 160) }}</p>
                        <div class="post-author" style="width:100%; margin-right:0; display:flex; align-items:center; justify-content:space-between; padding-bottom:14px; border-bottom:1px solid #eee; margin-bottom:10px;">
                            <a href="{{ route('post.details',$post->slug) }}" style="text-align:left;" aria-label="Read more about {{ $post->title }}">
                                <span style="top:0; color:#334155;">{{ __('Read More...')  }}</span>
                                <span style="top:0;"> &nbsp;&nbsp; </span>
                                <span style="top:0; color:#334155;">
                                    <i class="fal fa-calendar" style="color:#d97706;"></i> 
                                    @if($post->updated_at && $post->created_at && $post->created_at->format('Y-m-d') !== $post->updated_at->format('Y-m-d'))
                                        Updated: {{ $post->updated_at->toFormattedDateString() }}
                                    @elseif($post->created_at)
                                        {{ $post->created_at->toFormattedDateString() }}
                                    @endif
                                </span>
                            </a>
                            <span style="text-align:right; white-space:nowrap; top:0; color:#334155; font-size:13px; font-weight:600;">
                                <i class="fal fa-eye" style="color:#d97706; margin-right:3px;"></i> {{ $post->view }}
                            </span>
                        </div>
                        <div class="box-widget-item fl-wrap">
                            <div class="list-widget-social">
                                <ul>
                                    {!! single_post_share(route('post.details', $post->slug), $post->title, $post->image) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <!--article-masonry end -->
        @endforeach
        <div class="pagination-wrapper fl-wrap">
            {{ $posts->links() }}
        </div>
    </div>
    <!--post-container end -->
</div>
<!-- blog content end -->

