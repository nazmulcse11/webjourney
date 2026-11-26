
@if($posts->count() >= 1)
    <div class="wj-live-search-list">
        @foreach($posts as $post)
            @php
                $thumbPath = (!empty($post->image) && file_exists(public_path('images/post/' . $post->image)))
                    ? asset('images/post/' . $post->image)
                    : asset('frontend/images/default-post-668x445.png');
            @endphp
            <a href="{{ route('post.details', $post->slug) }}" class="wj-live-search-item">
                <img src="{{ $thumbPath }}" alt="{{ $post->title }}" width="56" height="34" loading="lazy">
                <span>{{ $post->title }}</span>
            </a>
        @endforeach
    </div>
@else
    <span class="wj-live-search-empty">{{ __('Nothing Found') }}</span>
@endif
