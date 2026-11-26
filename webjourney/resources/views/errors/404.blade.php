@extends('frontend.layouts.master')
@section('robots', 'noindex, follow')
@section('site_title', '404 Page Not Found - WebJourney')
@section('description', 'The page you are looking for could not be found. Browse our latest PHP, Laravel, JavaScript tutorials and interactive developer quizzes.')

@section('content')
    @php
        $latest_tutorials = \App\Models\Post::select(['title', 'slug'])
            ->where(['status' => 'publish', 'type' => 'post'])
            ->latest('updated_at')
            ->take(6)
            ->get();
        $quiz_types = \App\Models\QuizType::select(['type', 'slug'])
            ->where('status', 1)
            ->whereHas('quizzes')
            ->take(6)
            ->get();
    @endphp
    <div id="wrapper">
        <div class="content">
            <section class="middle-padding grey-blue-bg" style="min-height: calc(100vh - 140px);">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="list-single-main-item fl-wrap" style="padding: 36px 28px; border-radius: 12px; text-align: center;">
                                <div style="font-size: 64px; font-weight: 900; color: #183c7d; line-height: 1.1; margin-bottom: 8px;">404</div>
                                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">Oops! The Page You Requested Could Not Be Found</h1>
                                <p style="font-size: 15px; color: #64748b; max-width: 560px; margin: 0 auto 22px auto; line-height: 1.6; text-align: center !important;">
                                    The tutorial or URL may have been moved or mistyped. Use the links below to explore our latest tutorials and interactive coding quizzes.
                                </p>
                                <div style="margin-bottom: 30px;">
                                    <a href="{{ route('homepage') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #183c7d; color: #ffffff !important; font-size: 14.5px; font-weight: 700; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
                                        <i class="fas fa-home"></i> Back to Homepage
                                    </a>
                                </div>

                                @if($latest_tutorials->count() > 0)
                                <div style="text-align: left; border-top: 2px solid #f1f5f9; padding-top: 22px; margin-top: 10px;">
                                    <h2 style="font-size: 18px; font-weight: 800; color: #183c7d; margin: 0 0 12px 0; text-align: left;">Latest Developer Tutorials</h2>
                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        @foreach($latest_tutorials as $tut)
                                            <a href="{{ route('post.details', $tut->slug) }}" style="flex: 1 1 calc(50% - 10px); min-width: 230px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px; color: #1e293b; font-size: 14px; font-weight: 600; text-decoration: none; text-align: left; line-height: 1.4;">
                                                {{ $tut->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if($quiz_types->count() > 0)
                                <div style="text-align: left; border-top: 2px solid #f1f5f9; padding-top: 22px; margin-top: 22px;">
                                    <h2 style="font-size: 18px; font-weight: 800; color: #183c7d; margin: 0 0 12px 0; text-align: left;">Interactive Coding Quizzes</h2>
                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        @foreach($quiz_types as $qt)
                                            <a href="{{ route('quiz.tutorial', $qt->slug) }}" style="flex: 1 1 calc(50% - 10px); min-width: 230px; background: #fffdf5; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 14px; color: #183c7d; font-size: 14px; font-weight: 700; text-decoration: none; text-align: left; line-height: 1.4;">
                                                🎯 {{ $qt->type }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @include('frontend.pages.partials.sidebar')
                    </div>
                </div>
                <div class="limit-box fl-wrap"></div>
            </section>
        </div>
    </div>
@endsection
