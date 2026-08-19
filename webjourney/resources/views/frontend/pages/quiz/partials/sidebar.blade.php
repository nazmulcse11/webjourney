@php
    $types = App\Models\QuizType::whereHas('quizzes')->where('status', 1)->get();
    $all_categories = App\Models\Category::where('status', 1)
        ->whereHas('posts')
        ->latest()
        ->get();
@endphp


<!--   sidebar  -->
<div class="col-md-4">
    <!--box-widget-wrap -->
    <div class="box-widget-wrap fl-wrap fixed-bar fixbar-action">

        <!--sidebar display responsive ads -->
        <div class="box-widget-item fl-wrap">
            <div class="box-widget">
                <div class="box-widget-content">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8673885649672159"
                        crossorigin="anonymous"></script>
                    <!-- Sidebar Display Vertical Responsive Ads -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8673885649672159"
                        data-ad-slot="8434587589" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>
        <!--sidebar display responsive ads end -->

        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap">
            <div class="box-widget">
                <div class="box-widget-content">
                    <div class="box-widget-item-header">
                        <h3>{{ __('Quizzes') }}</h3>
                    </div>
                    <style>
                        /* Remove yellow decorative line under widget header */
                        .box-widget-item-header h3:before,
                        .box-widget-item-header h3:after,
                        .box-widget-item-header:before,
                        .box-widget-item-header:after {
                            display: none !important;
                            background: none !important;
                            border: none !important;
                            content: none !important;
                        }

                        .box-widget-item-header h3 {
                            border-bottom: none !important;
                            padding-bottom: 0 !important;
                        }

                        /* Remove all leader lines, dots, dashes, and pseudo elements from quiz category list */
                        .quiz-cat-list,
                        .quiz-cat-list li,
                        .quiz-cat-list li a {
                            border: none !important;
                            background: none !important;
                            box-shadow: none !important;
                        }

                        .quiz-cat-list li {
                            padding: 8px 0 !important;
                            line-height: 1.35 !important;
                            position: relative !important;
                        }

                        .quiz-cat-list li a {
                            float: none !important;
                            display: block !important;
                            width: 100% !important;
                            font-size: 14px !important;
                            font-weight: 600;
                            padding: 0 !important;
                            margin: 0 !important;
                            color: #566985;
                            transition: color 0.2s ease;
                        }

                        .quiz-cat-list li a:hover {
                            color: #F9B90F !important;
                        }

                        /* Hide all pseudo elements (:before and :after) on list items and links */
                        .quiz-cat-list:before,
                        .quiz-cat-list:after,
                        .quiz-cat-list li:before,
                        .quiz-cat-list li:after,
                        .quiz-cat-list li a:before,
                        .quiz-cat-list li a:after,
                        .quiz-cat-list span:before,
                        .quiz-cat-list span:after {
                            display: none !important;
                            content: none !important;
                            background: none !important;
                            border: none !important;
                            width: 0 !important;
                            height: 0 !important;
                        }
                    </style>
                    <ul class="cat-item">
                        @foreach($types as $type)
                            @php
                                $isCurrentQuiz = request()->routeIs('quiz.tutorial') && request()->route('slug') == $type->slug;
                            @endphp
                            <li>
                                <a href="{{ route('quiz.tutorial', $type->slug) }}"
                                    style="{{ $isCurrentQuiz ? 'color: #F9B90F !important; font-weight: 700;' : '' }}">
                                    {{ $type->type }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
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
                        @foreach($all_categories as $category)
                            <li><a href="{{ route('category.tutorial', $category->slug) }}">{{ $category->name }}</a>
                                <span>{{ optional($category->posts)->count() }}</span></li>
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