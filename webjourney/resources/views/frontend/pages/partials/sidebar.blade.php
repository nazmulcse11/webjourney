@php
    $all_categories = App\Models\Category::select(['id','name','slug'])->where('status',1)
                ->whereHas('posts')
                ->latest()
                ->get();
    $popular_posts = App\Models\Post::select(['title','slug'])->where(['status'=>'publish','type'=>'post'])
        ->orderBy('view','Desc')
        ->orderBy('like','Desc')
        ->orderBy('share','Desc')
        ->take(10)
        ->get();
@endphp


<!--   sidebar  -->
<div class="col-md-4">
    <!--box-widget-wrap -->
    <div class="box-widget-wrap fl-wrap fixed-bar fixbar-action">
        
         <!--sidebar display responsive ads -->
        <div class="box-widget-item fl-wrap">
            <div class="box-widget widget-posts">
                <div class="box-widget-content">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8673885649672159"
                         crossorigin="anonymous"></script>
                    <!-- Sidebar Display Vertical Responsive Ads -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-8673885649672159"
                         data-ad-slot="8434587589"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>
        <!--sidebar display responsive ads end -->
        
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap">
            <div class="box-widget widget-posts">
                <div class="box-widget-content">
                    <div class="box-widget-item-header">
                        <h3>{{ __('Popular Posts') }}</h3>
                    </div>
                    <!--box-image-widget-->
                    @foreach($popular_posts as $post)
                        <div class="box-image-widget">
                            <a style="text-align:left" href="{{ route('post.details',$post->slug) }}"><h4><i class="fal fa-angle-double-right"></i> {{ $post->title }}</h4></a>
                        </div>
                    @endforeach
                <!--box-image-widget end -->
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap">
            <div class="box-widget">
                <div class="box-widget-content">
                    <div class="box-widget-item-header">
                        <h3>{{ __('Categories') }}</h3>
                    </div>
                    <ul class="cat-item">
                        @foreach($all_categories as $cat)
                            <li><a href="{{ route('category.tutorial',$cat->slug) }}">{{ $cat->name }}</a> <span>{{ optional($cat->posts)->count() }}</span></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->
    </div>
    <!--box-widget-wrap end -->
</div>
<!--   sidebar end  -->
