@if(Auth::guard('web')->check())
    <div class="wishlist-wrap scrollbar-inner novis_wishlist">
        <div class="box-widget-content">
            <div class="widget-posts fl-wrap wishlist-content">
                <ul>
                    @php
                        $favourite_posts = \App\Models\AddToFavourite::where('user_id',Auth::guard('web')->user()->id)->latest()->take(3)->get();
                    @endphp
                    @foreach($favourite_posts as $post)
                        <li class="clearfix">
                            <a href="#"  class="widget-posts-img"><img src="{{ asset('images/post/'.optional($post->post)->image) }}" class="respimg" alt=""></a>
                            <div class="widget-posts-descr">
                                <div class="geodir-category-location fl-wrap"><a href="#">{{ optional($post->post)->title }}</a></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <a style="padding:10px" href="{{ route('user.favourites') }}">{{ __('View All') }}</a>
            </div>
        </div>
    </div>
@endif
