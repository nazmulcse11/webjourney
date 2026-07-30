<div class="nav-holder main-menu">
    <nav>
        <ul>
            <li>
                <a href="{{ route('homepage') }}">{{ __('Tutorials') }} <i class="fas fa-caret-down"></i></a>
                <ul>
                    @php $categories = App\Models\Category::whereHas('posts')->where('status',1)->get() @endphp
                    @foreach($categories as $category)
                        <li><a href="{{ route('category.tutorial',$category->slug ) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="{{ route('homepage') }}">{{ __('Quiz Test') }}  <i class="fas fa-caret-down"></i></a>
                <ul>
                    @php $types= App\Models\QuizType::whereHas('quizzes')->where('status',1)->get() @endphp
                    @foreach($types as $types)
                        <li><a href="{{ route('quiz.tutorial',$types->slug ) }}">{{ $types->type }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('about.us') }}">{{ __('About Us') }}</a></li>
            <li><a href="{{ route('contact.us') }}">{{ __('Contact Us') }}</a></li>
        </ul>
    </nav>
</div>
