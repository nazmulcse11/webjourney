@php
    $types= App\Models\QuizType::whereHas('quizzes')->where('status',1)->get();
    $all_categories = App\Models\Category::where('status',1)
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
                <div class="box-widget">
                    <div class="box-widget-content">
                        <div class="box-widget-item-header">
                            <h3>{{ __('Quizzes') }}</h3>
                        </div>
                        <ul class="cat-item">
                            @foreach($types as $type)
                                <li>
                                    <a href="{{ route('quiz.tutorial',$type->slug ) }}">
                                       {{ ucwords(str_replace('-',' ',$type->slug )) }}
                                    </a>
                                    <span>{{ optional($type->quizzes)->count() }}</span>
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
                            <li><a href="{{ route('category.tutorial',$category->slug) }}">{{ $category->name }}</a> <span>{{ optional($category->posts)->count() }}</span></li>
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
