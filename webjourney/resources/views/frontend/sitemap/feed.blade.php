{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>WebJourney - PHP, Laravel, JavaScript &amp; Web Development Tutorials</title>
        <link>{{ route('homepage') }}</link>
        <description>{{ get_static_option('description') ?: 'Practical PHP, Laravel, MySQL, JavaScript, jQuery, Vue.js, React, and Web Development tutorials and interactive quizzes.' }}</description>
        <language>en-us</language>
        <lastBuildDate>{{ $latestPostDate->toRssString() }}</lastBuildDate>
        <atom:link href="{{ route('rss.feed') }}" rel="self" type="application/rss+xml" />
        @foreach($posts as $post)
            @php
                $postUrl = route('post.details', $post->slug);
                $excerpt = !empty($post->meta_description)
                    ? $post->meta_description
                    : \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($post->description))), 220);
                $imageUrl = !empty($post->image)
                    ? asset('images/post/' . $post->image)
                    : asset('frontend/images/default-post-668x445.png');
            @endphp
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ $postUrl }}</link>
                <guid isPermaLink="true">{{ $postUrl }}</guid>
                <description><![CDATA[{{ $excerpt }}]]></description>
                <pubDate>{{ ($post->created_at ?? $post->updated_at ?? now())->toRssString() }}</pubDate>
                @foreach($post->categories as $cat)
                    <category><![CDATA[{{ $cat->name }}]]></category>
                @endforeach
                <media:content url="{{ $imageUrl }}" medium="image" />
            </item>
        @endforeach
    </channel>
</rss>
