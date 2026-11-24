<!--blog content -->
<div class="col-md-8">
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
                                    <i class="fal fa-calendar" style="color:#F9B90F;"></i> 
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
        <div class="pagination-wrapper fl-wrap">
            {{ $posts->links() }}
        </div>
    </div>
    <!--post-container end -->
</div>
<!-- blog content end -->

