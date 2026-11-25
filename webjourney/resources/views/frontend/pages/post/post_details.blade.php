@extends('frontend.layouts.master')
    @php
        $rawMetaTitle = trim((string) ($post_details->meta_title ?? ''));
        $isInvalidMetaTitle = $rawMetaTitle === ''
            || strpos($rawMetaTitle, ' ') === false
            || (mb_strlen($rawMetaTitle) < 32 && mb_strlen($post_details->title) > 35 && strtolower($rawMetaTitle) === $rawMetaTitle);
        $seoTitle = $isInvalidMetaTitle ? $post_details->title : $rawMetaTitle;
        $cleanExcerpt = Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($post_details->description))), 155);
        $seoDescription = !empty($post_details->meta_description) ? $post_details->meta_description : $cleanExcerpt;
        $postUrl = route('post.details', $post_details->slug);
        $postImage = !empty($post_details->image)
            ? asset('images/post/' . $post_details->image)
            : asset('frontend/images/default-post-668x445.png');
        $primaryCategory = $post_details->categories->first();

        $schemaGraph = [
            [
                '@type' => 'TechArticle',
                '@id' => $postUrl . '#article',
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $postUrl,
                ],
                'headline' => $seoTitle,
                'description' => $seoDescription,
                'image' => [$postImage],
                'datePublished' => optional($post_details->created_at)->toAtomString(),
                'dateModified' => optional($post_details->updated_at ?? $post_details->created_at)->toAtomString(),
                'author' => [
                    '@type' => 'Person',
                    'name' => 'Nazmul Hoque',
                    'url' => route('about.us'),
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'WebJourney',
                    'url' => url('/'),
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('frontend/images/web-journey-your-web-tutor.png'),
                    ],
                ],
                'articleSection' => $primaryCategory ? $primaryCategory->name : 'Web Development',
                'keywords' => $post_details->tags->pluck('name')->implode(', '),
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $postUrl . '#breadcrumb',
                'itemListElement' => array_values(array_filter([
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => route('homepage'),
                    ],
                    $primaryCategory ? [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => $primaryCategory->name,
                        'item' => route('category.tutorial', $primaryCategory->slug),
                    ] : null,
                    [
                        '@type' => 'ListItem',
                        'position' => $primaryCategory ? 3 : 2,
                        'name' => $post_details->title,
                        'item' => $postUrl,
                    ],
                ])),
            ],
        ];

        if (!empty($faq_items) && count($faq_items) >= 1) {
            $schemaGraph[] = [
                '@type' => 'FAQPage',
                '@id' => $postUrl . '#faq',
                'mainEntity' => array_map(function ($faq) {
                    return [
                        '@type' => 'Question',
                        'name' => $faq['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => trim(preg_replace('/\s+/', ' ', strip_tags($faq['answer']))),
                        ],
                    ];
                }, $faq_items),
            ];
        }
    @endphp
    @section('site_title'){{ $seoTitle }}@endsection
    @section('description'){{ $seoDescription }}@endsection
    @section('canonical'){{ $postUrl }}@endsection
    @section('og_type', 'article')
    @section('og_url'){{ $postUrl }}@endsection
    @section('og_title'){{ $seoTitle }}@endsection
    @section('og_description'){{ $seoDescription }}@endsection
    @section('og_image'){{ $postImage }}@endsection
    @section('schema')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => $schemaGraph,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endsection
    
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
        /* Visible SEO Breadcrumb Bar */
        .wj-post-breadcrumb {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
        }
        .wj-post-breadcrumb a {
            color: #183c7d;
            font-weight: 600;
            text-decoration: none;
        }
        .wj-post-breadcrumb a:hover {
            color: #F9B90F;
        }
        .wj-post-breadcrumb .wj-bc-sep {
            color: #94a3b8;
        }
        .wj-post-breadcrumb .wj-bc-current {
            color: #64748b;
            font-weight: 500;
        }
        /* Auto-Generated Table of Contents */
        .wj-toc-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #183c7d;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 14px 0 22px 0;
            text-align: left;
            clear: both;
            width: 100%;
        }
        .wj-toc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            color: #183c7d;
            margin: 0;
        }
        .wj-toc-toggle-btn {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            background: #e2e8f0;
            padding: 3px 10px;
            border-radius: 4px;
        }
        .wj-toc-list {
            list-style: none !important;
            margin: 12px 0 0 0 !important;
            padding: 0 !important;
        }
        .wj-toc-list li {
            margin-bottom: 7px !important;
            line-height: 1.45 !important;
            text-align: left !important;
            float: none !important;
            width: 100% !important;
        }
        .wj-toc-list li.toc-level-3 {
            padding-left: 18px !important;
            font-size: 13.5px !important;
        }
        .wj-toc-list li a {
            color: #1e293b;
            font-size: 14.5px;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .wj-toc-list li a:hover {
            color: #183c7d;
            text-decoration: underline;
        }
        /* Interactive Quiz CTA Banner inside Tutorial */
        .wj-quiz-cta-card {
            background: linear-gradient(135deg, #183c7d 0%, #1e40af 100%);
            border-radius: 12px;
            padding: 20px 24px;
            margin: 24px 0 18px 0;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            text-align: left;
            clear: both;
            width: 100%;
            box-shadow: 0 8px 20px rgba(24, 60, 125, 0.18);
        }
        .wj-quiz-cta-info {
            flex: 1 1 280px;
        }
        .wj-quiz-cta-badge {
            display: inline-block;
            background: rgba(249, 185, 15, 0.2);
            color: #F9B90F;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            padding: 3px 10px;
            border-radius: 99px;
            margin-bottom: 6px;
        }
        .wj-quiz-cta-title {
            font-size: 18px !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin: 0 0 4px 0 !important;
            line-height: 1.35 !important;
        }
        .wj-quiz-cta-sub {
            font-size: 13.5px !important;
            color: rgba(255, 255, 255, 0.85) !important;
            margin: 0 !important;
            line-height: 1.45 !important;
        }
        .wj-quiz-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F9B90F;
            color: #0f172a !important;
            font-size: 14px;
            font-weight: 700;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none !important;
            transition: transform 0.2s ease, background 0.2s ease;
            white-space: nowrap;
        }
        .wj-quiz-cta-btn:hover {
            background: #fbbf24;
            transform: translateY(-2px);
        }
        /* Previous & Next Post Navigation */
        .wj-prev-next-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            width: 100%;
            clear: both;
            margin-top: 5px;
        }
        .wj-prev-next-card {
            flex: 1 1 calc(50% - 10px);
            min-width: 240px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
            text-align: left;
            text-decoration: none !important;
            transition: all 0.2s ease;
            display: block;
        }
        .wj-prev-next-card:hover {
            border-color: #183c7d;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(24, 60, 125, 0.08);
        }
        .wj-pn-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 4px;
        }
        .wj-pn-title {
            display: block;
            font-size: 14.5px;
            font-weight: 600;
            color: #183c7d;
            line-height: 1.35;
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
                                    <nav class="wj-post-breadcrumb" aria-label="Breadcrumb">
                                        <a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Home</a>
                                        @if($primaryCategory)
                                            <span class="wj-bc-sep">›</span>
                                            <a href="{{ route('category.tutorial', $primaryCategory->slug) }}">{{ $primaryCategory->name }}</a>
                                        @endif
                                        <span class="wj-bc-sep">›</span>
                                        <span class="wj-bc-current">{{ Str::limit($post_details->title, 65) }}</span>
                                    </nav>

                                    <div class="list-single-main-item-title description_heading_title fl-wrap">
                                        <h1>{{ $post_details->title }}</h1>
                                    </div>

                                    @if(!empty($toc_items) && count($toc_items) >= 3)
                                    <div class="wj-toc-box">
                                        <div class="wj-toc-header" onclick="var list = document.getElementById('wj-toc-list'); var btn = document.getElementById('wj-toc-btn'); if (list.style.display === 'none') { list.style.display = 'block'; btn.innerText = 'Hide'; } else { list.style.display = 'none'; btn.innerText = 'Show'; }">
                                            <span><i class="fal fa-list-ul" style="margin-right:8px;"></i> Table of Contents</span>
                                            <span class="wj-toc-toggle-btn" id="wj-toc-btn">Hide</span>
                                        </div>
                                        <ul class="wj-toc-list" id="wj-toc-list">
                                            @foreach($toc_items as $index => $item)
                                                <li class="toc-level-{{ $item['level'] }}">
                                                    <a href="#{{ $item['id'] }}">{{ $item['text'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <div class="post-description-content">
                                        {!! $post_details->description !!}
                                    </div>

                                    @if(!empty($custom_faqs) && count($custom_faqs) > 0)
                                    <div id="post-faq-section" style="margin: 28px 0 20px 0; padding: 22px 24px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; text-align: left !important; clear: both; float: none !important; width: 100%; box-sizing: border-box;">
                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid #e2e8f0; width: 100%; clear: both;">
                                            <span style="width: 34px; height: 34px; border-radius: 8px; background: #183c7d; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; flex-shrink: 0;">?</span>
                                            <h2 style="font-size: 20px !important; font-weight: 800 !important; color: #183c7d !important; margin: 0 !important; padding: 0 !important; line-height: 1.3 !important; float: none !important; width: auto !important; text-align: left !important; border: none !important;">
                                                {{ __('Frequently Asked Questions (FAQ)') }}
                                            </h2>
                                        </div>
                                        <div style="display: flex; flex-direction: column; gap: 12px; width: 100%; clear: both;">
                                            @foreach($custom_faqs as $fIdx => $faq)
                                                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-left: 4px solid #183c7d; border-radius: 8px; padding: 14px 18px; text-align: left !important; width: 100%; box-sizing: border-box; clear: both; float: none !important;">
                                                    <h3 style="display: block !important; width: 100% !important; float: none !important; clear: both !important; text-align: left !important; font-size: 16px !important; font-weight: 700 !important; color: #183c7d !important; margin: 0 0 8px 0 !important; padding: 0 0 6px 0 !important; border-bottom: 1px dashed #e2e8f0 !important; line-height: 1.45 !important;">
                                                        {{ $fIdx + 1 }}. {{ $faq['question'] }}
                                                    </h3>
                                                    <div style="display: block !important; width: 100% !important; float: none !important; clear: both !important; text-align: left !important; font-size: 14.5px !important; color: #334155 !important; line-height: 1.65 !important; margin: 0 !important;">
                                                        {!! nl2br(e($faq['answer'])) !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    @if(!empty($matched_quiz))
                                    <div class="wj-quiz-cta-card">
                                        <div class="wj-quiz-cta-info">
                                            <span class="wj-quiz-cta-badge">🎯 Interactive Skill Assessment</span>
                                            <div class="wj-quiz-cta-title">{{ $matched_quiz->type }}</div>
                                            <p class="wj-quiz-cta-sub">Test what you just learned with {{ $matched_quiz->quizzes_count ?? '' }} interactive multiple-choice questions and instant explanations.</p>
                                        </div>
                                        <a href="{{ route('quiz.tutorial', $matched_quiz->slug) }}" class="wj-quiz-cta-btn">
                                            Start Free Quiz <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    @endif
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
                                        </ul>
                                    </div>
                                    <span class="fw-separator" style="margin: 10px 0 8px 0 !important;"></span>
                                    <div class="list-single-main-item-title fl-wrap" style="padding: 0 0 4px 0 !important; margin: 0 0 6px 0 !important;">
                                        <h3 style="margin: 0 !important; padding: 0 !important; line-height: 1.3 !important;">{{ __('Tags') }}</h3>
                                    </div>
                                    <div class="list-single-tags tags-stylwrap blog-tags" style="margin: 0 !important; padding: 0 !important;">
                                        @foreach($post_details->tags as $tag)
                                            <a href="{{ route('tag.tutorial',$tag->slug) }}" style="margin-bottom: 4px !important; margin-top: 2px !important;">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>

                                    <span class="fw-separator" style="margin: 4px 0 6px 0 !important;"></span>
                                    <div class="box-widget-item fl-wrap" style="margin: 0 !important; padding: 0 !important;">
                                        <div class="list-widget-social">
                                            <ul>
                                                <li><p style="margin: 0 10px 0 0 !important;">{{ __('Share This:') }}</p></li>
                                                @php $post_img = !empty($post_details->image) ? asset('images/post/'.$post_details->image) : ''; @endphp
                                                {!! single_post_share(route('post.details', $post_details->slug), $post_details->title, $post_img) !!}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- prev / next tutorial navigation -->
                                @if(!empty($previous_post) || !empty($next_post))
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="wj-prev-next-grid">
                                            @if(!empty($previous_post))
                                                <a href="{{ route('post.details', $previous_post->slug) }}" class="wj-prev-next-card">
                                                    <span class="wj-pn-label"><i class="fas fa-arrow-left"></i> Previous Tutorial</span>
                                                    <span class="wj-pn-title">{{ $previous_post->title }}</span>
                                                </a>
                                            @endif
                                            @if(!empty($next_post))
                                                <a href="{{ route('post.details', $next_post->slug) }}" class="wj-prev-next-card">
                                                    <span class="wj-pn-label">Next Tutorial <i class="fas fa-arrow-right"></i></span>
                                                    <span class="wj-pn-title">{{ $next_post->title }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- random post start-->
                                    <div class="list-single-main-item fl-wrap" id="sec5" style="padding: 24px 26px !important; border-radius: 12px !important;">
                                        @if($post_details)
                                        <div style="text-align: left; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 2px solid #f1f5f9; width: 100%; clear: both;">
                                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                                                <span style="width: 34px; height: 34px; border-radius: 8px; background: #e0e7ff; color: #183c7d; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#183c7d" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                                </span>
                                                <h3 style="font-size: 20px !important; font-weight: 800 !important; color: #183c7d !important; margin: 0 !important; padding: 0 !important; border: none !important; line-height: 1.3 !important;">
                                                    {{ __('You May Also Like Below Articles') }}
                                                </h3>
                                            </div>
                                            <p style="font-size: 13.5px !important; color: #64748b !important; margin: 4px 0 0 44px !important; font-weight: 500 !important; line-height: 1.4 !important; text-align: left !important;">
                                                {{ __('Handpicked related tutorials and step-by-step developer guides to continue learning.') }}
                                            </p>
                                        </div>

                                        <style>
                                            .wj-related-grid {
                                                display: flex !important;
                                                flex-wrap: wrap !important;
                                                gap: 12px !important;
                                                width: 100% !important;
                                                clear: both !important;
                                            }
                                            .wj-related-item {
                                                flex: 1 1 calc(50% - 12px) !important;
                                                min-width: 250px !important;
                                                background: #f8fafc !important;
                                                border: 1.5px solid #e2e8f0 !important;
                                                border-radius: 10px !important;
                                                padding: 14px 16px !important;
                                                display: flex !important;
                                                align-items: flex-start !important;
                                                gap: 12px !important;
                                                text-decoration: none !important;
                                                transition: all 0.22s ease !important;
                                                box-sizing: border-box !important;
                                                text-align: left !important;
                                            }
                                            .wj-related-item:hover {
                                                background: #ffffff !important;
                                                border-color: #183c7d !important;
                                                transform: translateY(-2px) !important;
                                                box-shadow: 0 8px 20px rgba(24, 60, 125, 0.1) !important;
                                            }
                                            .wj-related-icon {
                                                width: 36px !important;
                                                height: 36px !important;
                                                border-radius: 8px !important;
                                                background: #e0e7ff !important;
                                                color: #183c7d !important;
                                                display: flex !important;
                                                align-items: center !important;
                                                justify-content: center !important;
                                                flex-shrink: 0 !important;
                                                margin-top: 1px !important;
                                                transition: background 0.2s ease, color 0.2s ease !important;
                                            }
                                            .wj-related-item:hover .wj-related-icon {
                                                background: #183c7d !important;
                                                color: #ffffff !important;
                                            }
                                            .wj-related-item:hover .wj-related-icon svg {
                                                stroke: #ffffff !important;
                                            }
                                            .wj-related-body {
                                                flex: 1 !important;
                                                min-width: 0 !important;
                                                text-align: left !important;
                                            }
                                            .wj-related-title {
                                                font-size: 14.5px !important;
                                                font-weight: 700 !important;
                                                color: #1e293b !important;
                                                line-height: 1.4 !important;
                                                margin: 0 0 4px 0 !important;
                                                display: block !important;
                                                transition: color 0.2s ease !important;
                                            }
                                            .wj-related-item:hover .wj-related-title {
                                                color: #183c7d !important;
                                            }
                                            .wj-related-cta {
                                                font-size: 12px !important;
                                                font-weight: 600 !important;
                                                color: #64748b !important;
                                                display: inline-flex !important;
                                                align-items: center !important;
                                                gap: 4px !important;
                                                transition: color 0.2s ease !important;
                                            }
                                            .wj-related-item:hover .wj-related-cta {
                                                color: #F9B90F !important;
                                            }
                                        </style>

                                        <div class="wj-related-grid">
                                            @foreach($random_posts as $post)
                                                <a href="{{ route('post.details', $post->slug) }}" class="wj-related-item">
                                                    <span class="wj-related-icon">
                                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#183c7d" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                                    </span>
                                                    <div class="wj-related-body">
                                                        <span class="wj-related-title">{{ $post->title }}</span>
                                                        <span class="wj-related-cta">Read Tutorial <i class="fas fa-arrow-right" style="font-size:10px;"></i></span>
                                                    </div>
                                                </a>
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

