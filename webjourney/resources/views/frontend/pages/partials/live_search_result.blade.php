
@if($posts->count() >=1 )
    @foreach($posts as $post)
        <a href="{{ route('post.details',$post->slug) }}">
            <img style="width:50px; margin:10px;" src="{{ asset('images/post/'.$post->image) }}" alt="">
            {{ $post->title }}
        </a>
    <br>
    @endforeach
@else
    <span style="color:red;margin:10px;">{{ __('Nothing Found') }}</span>
@endif
