{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('homepage') }}</loc>
        <lastmod>{{ $latestPostDate->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>
    @foreach($posts as $post)
    <url>
        <loc>{{ route('post.details', $post->slug) }}</loc>
        <lastmod>{{ ($post->updated_at ?? $post->created_at ?? now())->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    @endforeach
    @foreach($quizzes as $quiz)
    <url>
        <loc>{{ route('quiz.tutorial', $quiz->slug) }}</loc>
        <lastmod>{{ ($quiz->updated_at ?? $quiz->created_at ?? $latestPostDate)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.85</priority>
    </url>
    @endforeach
    @foreach($categories as $category)
    <url>
        <loc>{{ route('category.tutorial', $category->slug) }}</loc>
        <lastmod>{{ ($category->updated_at ?? $category->created_at ?? $latestPostDate)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    @endforeach
    @foreach($subcategories as $subcategory)
    <url>
        <loc>{{ route('subcategory.tutorial', $subcategory->slug) }}</loc>
        <lastmod>{{ ($subcategory->updated_at ?? $subcategory->created_at ?? $latestPostDate)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.75</priority>
    </url>
    @endforeach
    <url>
        <loc>{{ route('about.us') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.50</priority>
    </url>
    <url>
        <loc>{{ route('contact.us') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.50</priority>
    </url>
    <url>
        <loc>{{ route('privacy.policy') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.30</priority>
    </url>
    <url>
        <loc>{{ route('terms.of.use') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.30</priority>
    </url>
</urlset>
