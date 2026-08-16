<div class="nav-holder main-menu">
    <nav>
        <ul>
            @php 
                $categories = App\Models\Category::where('status', 1)->with(['sub_categories' => function($q) {
                    $q->where('status', 1);
                }])->get(); 
            @endphp
            @foreach($categories as $category)
                @php
                    $isCurrentCategory = request()->routeIs('category.tutorial') && request()->route('category') == $category->slug;
                @endphp
                <li>
                    <a href="{{ route('category.tutorial', $category->slug) }}" class="{{ $isCurrentCategory ? 'act-link' : '' }}">
                        {{ $category->name }} 
                    </a>
                </li>
            @endforeach
            <li>
                <a href="{{ route('homepage') }}">{{ __('Quiz Test') }}  <i class="fas fa-caret-down"></i></a>
                <ul style="width: 320px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <style>
                        /* Make all standard dropdown text 15px to match */
                        .nav-holder nav li ul a {
                            font-size: 15px !important;
                        }
                        .quiz-dropdown-item {
                            white-space: normal; 
                            line-height: 1.4; 
                            padding: 12px 18px !important; 
                            display: flex !important; 
                            align-items: center; 
                            gap: 12px; 
                            transition: all 0.2s;
                        }
                        .quiz-dropdown-item:hover {
                            background-color: #f8fafc !important;
                        }
                        .quiz-dropdown-item:hover .quiz-title {
                            color: #F9B90F !important; /* Matches theme highlight color */
                        }
                        .quiz-title {
                            font-weight: 700; 
                            color: #1e293b; 
                            font-size: 15px;
                            transition: color 0.2s;
                            display: block;
                        }
                        .quiz-subtext {
                            font-size: 12px; 
                            color: #64748b; 
                            margin-top: 2px;
                            display: block;
                        }
                        .quiz-icon-box {
                            background: #e0e7ff; 
                            color: #4338ca; 
                            width: 36px; 
                            height: 36px; 
                            border-radius: 8px; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            font-weight: bold; 
                            flex-shrink: 0; 
                            font-size: 16px;
                        }
                    </style>
                    @php $types= App\Models\QuizType::whereHas('quizzes')->where('status',1)->get() @endphp
                    @foreach($types as $type)
                        <li>
                            <a href="{{ route('quiz.tutorial',$type->slug ) }}" class="quiz-dropdown-item">
                                <span class="quiz-icon-box">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="16 18 22 12 16 6"></polyline>
                                        <polyline points="8 6 2 12 8 18"></polyline>
                                    </svg>
                                </span>
                                <div>
                                    <span class="quiz-title">{{ $type->type }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
</div>
