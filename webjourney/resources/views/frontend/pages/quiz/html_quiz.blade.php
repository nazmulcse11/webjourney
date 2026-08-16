@extends('frontend.layouts.master')
@section('site_title'){{__('Webjourney')}} - {{ $type->type }} Quiz Test @endsection
@section('description', get_static_option('description'))
@section('og_url'){{ route('quiz.tutorial', $type->slug) }} @endsection
@section('og_title'){{ $type->type }} Quiz Test @endsection
@section('og_description'){{ $type->type }} Quiz Test - Check Your Skill @endsection
@section('og_image'){{asset('frontend/images/web-journey-your-web-tutor.png')}} @endsection

@section('css')
    <style>
        /* ===== RESET INSIDE DASHBOARD (fight theme overrides) ===== */
        #quiz-stats-dashboard,
        #quiz-stats-dashboard * {
            box-sizing: border-box;
        }

        /* ===== DASHBOARD WRAPPER ===== */
        #quiz-stats-dashboard {
            background: #0f172a;
            border-radius: 16px;
            padding: 14px 16px 12px;
            margin-bottom: 24px;
            border: 1px solid rgba(99, 102, 241, 0.22);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        /* ===== STAT CARDS ROW (table-cell trick avoids float interference) ===== */
        .qsd-row {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin-bottom: 12px;
        }

        .qsd-cell {
            display: table-cell;
            vertical-align: middle;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 10px;
            padding: 9px 10px;
            text-align: center;
            position: relative;
        }

        .qsd-cell-top {
            display: block;
            height: 3px;
            border-radius: 10px 10px 0 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: #6366f1;
        }

        .qsd-cell-top.c-green {
            background: linear-gradient(90deg, #22c55e, #16a34a);
        }

        .qsd-cell-top.c-red {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

        .qsd-cell-top.c-yellow {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .qsd-cell-top.c-blue {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
        }

        .qsd-cell-top.c-purple {
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
        }

        .qsd-cell-icon {
            font-size: 18px;
            display: block;
            margin-bottom: 2px;
            line-height: 1;
        }

        .qsd-cell-label {
            display: block;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: rgba(255, 255, 255, 0.45);
            font-weight: 700;
            margin-bottom: 2px;
            font-family: sans-serif;
        }

        .qsd-cell-value {
            display: block;
            font-size: 19px;
            font-weight: 800;
            color: #f1f5f9;
            line-height: 1;
            font-family: monospace;
        }

        .qsd-cell-value sup {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.35);
            font-family: sans-serif;
        }

        /* Timer colour states */
        #qsd-time-display.color-green {
            color: #4ade80;
        }

        #qsd-time-display.color-yellow {
            color: #fbbf24;
        }

        #qsd-time-display.color-red {
            color: #f87171;
        }

        /* Danger pulse on timer card */
        @keyframes qsd-danger-pulse {

            0%,
            100% {
                border-color: rgba(239, 68, 68, 0.3);
            }

            50% {
                border-color: rgba(239, 68, 68, 0.9);
                box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
            }
        }

        .qsd-cell.danger-pulse {
            animation: qsd-danger-pulse 1s ease infinite;
        }

        /* ===== PROGRESS BAR ===== */
        .qsd-pbar-wrap {
            display: block;
            width: 100%;
        }

        .qsd-pbar-meta {
            display: table;
            width: 100%;
            margin-bottom: 4px;
        }

        .qsd-pbar-meta-left,
        .qsd-pbar-meta-right {
            display: table-cell;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: rgba(255, 255, 255, 0.4);
            font-family: sans-serif;
        }

        .qsd-pbar-meta-right {
            text-align: right;
        }

        .qsd-pbar-track {
            display: block;
            height: 8px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 99px;
            overflow: hidden;
            position: relative;
        }

        .qsd-pbar-fill {
            display: block;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
            border-radius: 99px;
            -webkit-transition: width 0.45s cubic-bezier(0.4, 0, 0.2, 1);
            transition: width 0.45s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== QUIZ QUESTION BLOCKS ===== */
        .quiz-question-block {
            background: #fff;
            border-radius: 14px;
            padding: 20px 20px 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
            border: 1.5px solid #e9ecef;
            -webkit-transition: box-shadow 0.3s ease;
            transition: box-shadow 0.3s ease;
            margin-bottom: 0;
            text-align: left !important;
        }

        .quiz-question-block:hover {
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.11);
        }

        .qq-header {
            display: table;
            width: 100%;
            margin-bottom: 14px;
            text-align: left !important;
        }

        .qq-number-cell {
            display: table-cell;
            vertical-align: top;
            width: 44px;
            padding-top: 1px;
            text-align: left !important;
        }

        .qq-number {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff !important;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.4px;
            font-family: sans-serif;
        }

        .qq-title-cell {
            display: table-cell;
            vertical-align: top;
            text-align: left !important;
        }

        .qq-title {
            font-size: 15.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.55;
            margin: 0;
            text-align: left !important;
        }

        /* ===== OPTIONS ===== */
        .qq-options {
            display: block;
            margin: 0;
            padding: 0;
        }

        .qq-option-label {
            display: table;
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            cursor: pointer;
            background: #fafbfc;
            margin-bottom: 7px;
            -webkit-transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            user-select: none;
            -webkit-user-select: none;
        }

        .qq-option-label:last-child {
            margin-bottom: 0;
        }

        .qq-option-label:hover:not(.disabled) {
            border-color: #6366f1;
            background: #f0f0ff;
            box-shadow: 2px 0 0 0 #6366f1 inset;
        }

        .qq-option-label input[type=radio] {
            display: none;
        }

        .qq-opt-letter-cell {
            display: table-cell;
            vertical-align: middle;
            width: 34px;
        }

        .qq-option-letter {
            display: inline-block;
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: #e0e7ff;
            color: #4338ca !important;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
            line-height: 28px;
            -webkit-transition: background 0.2s, color 0.2s;
            transition: background 0.2s, color 0.2s;
            font-family: sans-serif;
        }

        .qq-opt-text-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: left !important;
        }

        .qq-option-text {
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            line-height: 1.45;
            font-family: sans-serif;
            text-align: left !important;
        }

        .qq-opt-check-cell {
            display: table-cell;
            vertical-align: middle;
            width: 28px;
            text-align: right;
        }

        .qq-option-check {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            text-align: center;
            line-height: 16px;
            font-size: 11px;
            font-weight: 800;
            color: transparent;
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
        }

        /* Correct option */
        .qq-option-label.option-correct {
            border-color: #22c55e !important;
            background: linear-gradient(135deg, #f0fdf4, #dcfce7) !important;
            box-shadow: 3px 0 0 0 #22c55e inset;
        }

        .qq-option-label.option-correct .qq-option-letter {
            background: #22c55e !important;
            color: #fff !important;
        }

        .qq-option-label.option-correct .qq-option-check {
            border-color: #22c55e;
            background: #22c55e;
            color: #fff;
        }

        .qq-option-label.option-correct .qq-option-check::before {
            content: '✓';
        }

        /* Wrong option */
        .qq-option-label.option-wrong {
            border-color: #ef4444 !important;
            background: linear-gradient(135deg, #fff5f5, #fee2e2) !important;
            box-shadow: 3px 0 0 0 #ef4444 inset;
        }

        .qq-option-label.option-wrong .qq-option-letter {
            background: #ef4444 !important;
            color: #fff !important;
        }

        .qq-option-label.option-wrong .qq-option-check {
            border-color: #ef4444;
            background: #ef4444;
            color: #fff;
        }

        .qq-option-label.option-wrong .qq-option-check::before {
            content: '✗';
        }

        .qq-option-label.disabled {
            cursor: not-allowed !important;
        }

        /* ===== ANSWER FEEDBACK ===== */
        .answer-block {
            display: none;
            margin-top: 12px;
            clear: both;
            padding: 0 !important;
            margin-bottom: 0 !important;
        }

        .answer-card {
            border-radius: 10px;
            padding: 12px 16px;
            display: block;
        }

        .answer-card.correct {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #bbf7d0;
            border-left: 5px solid #22c55e;
        }

        .answer-card.wrong {
            background: linear-gradient(135deg, #fff5f5, #fee2e2);
            border: 1px solid #fecaca;
            border-left: 5px solid #ef4444;
        }

        .answer-header {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 4px;
            font-family: sans-serif;
        }

        .answer-card.correct .answer-header {
            color: #15803d;
        }

        .answer-card.wrong .answer-header {
            color: #b91c1c;
        }

        .answer-detail {
            font-size: 13px;
            color: #374151;
            line-height: 1.55;
            font-family: sans-serif;
        }

        .answer-detail strong {
            color: #183c7d;
        }

        .answer-explanation {
            font-size: 12.5px;
            color: #4b5563;
            margin-top: 7px;
            padding-top: 7px;
            border-top: 1px dashed rgba(0, 0, 0, 0.12);
            line-height: 1.6;
            font-family: sans-serif;
        }

        /* ===== SEPARATOR ===== */
        .quiz-separator {
            display: block;
            height: 0;
            border: none;
            border-top: 1.5px dashed #dee2e6;
            margin: 16px 0;
            clear: both;
        }

        /* ===== RESULT PANEL ===== */
        #quiz-result-panel {
            margin-top: 28px;
            background: #0f172a;
            border-radius: 18px;
            padding: 36px 20px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(99, 102, 241, 0.2);
            clear: both;
        }

        .qrp-emoji {
            font-size: 56px;
            display: block;
            margin-bottom: 8px;
        }

        .qrp-title {
            font-size: 26px;
            font-weight: 800;
            color: #f1f5f9;
            margin: 0 0 6px;
            font-family: sans-serif;
        }

        .qrp-sub {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 24px;
            font-family: sans-serif;
        }

        .qrp-row {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-bottom: 24px;
        }

        .qrp-cell {
            display: table-cell;
            vertical-align: middle;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 8px;
            text-align: center;
        }

        .qrp-cell-val {
            display: block;
            font-size: 28px;
            font-weight: 800;
            color: #22c55e;
            font-family: monospace;
        }

        .qrp-cell-val.c-red {
            color: #f87171;
        }

        .qrp-cell-val.c-yellow {
            color: #fbbf24;
        }

        .qrp-cell-val.c-blue {
            color: #60a5fa;
            font-size: 20px;
        }

        .qrp-cell-lbl {
            display: block;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.38);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            margin-top: 3px;
            font-family: sans-serif;
        }

        .qrp-retry-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff !important;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            -webkit-transition: transform 0.2s, box-shadow 0.2s;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
            font-family: sans-serif;
            display: inline-block;
        }

        .qrp-retry-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(99, 102, 241, 0.5);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 600px) {
            .qsd-cell-value {
                font-size: 15px;
            }

            .qsd-cell-icon {
                font-size: 14px;
            }

            .qq-title {
                font-size: 14px;
            }

        /* ===== OTHER QUIZZES BOTTOM CARD (ISOLATED STYLES) ===== */
        .other-quizzes-card,
        .other-quizzes-card * {
            box-sizing: border-box !important;
            float: none !important;
        }

        .other-quizzes-card {
            background: #ffffff !important;
            border-radius: 16px !important;
            padding: 24px 28px !important;
            margin-top: 35px !important;
            margin-bottom: 25px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border: 1.5px solid #e2e8f0 !important;
            clear: both !important;
            display: block !important;
            width: 100% !important;
            text-align: left !important;
        }

        .other-quizzes-card .oqc-header {
            text-align: left !important;
            margin-bottom: 20px !important;
            padding-bottom: 14px !important;
            border-bottom: 2px solid #f1f5f9 !important;
            display: block !important;
            width: 100% !important;
        }

        .other-quizzes-card .oqc-title {
            font-size: 20px !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            margin: 0 0 6px 0 !important;
            display: block !important;
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            line-height: 1.3 !important;
            border: none !important;
            padding: 0 !important;
            text-align: left !important;
        }

        .other-quizzes-card .oqc-title i {
            color: #4f46e5 !important;
            margin-right: 8px !important;
        }

        .other-quizzes-card .oqc-sub {
            font-size: 14px !important;
            color: #64748b !important;
            margin: 0 !important;
            font-weight: 500 !important;
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            display: block !important;
            line-height: 1.5 !important;
            text-align: left !important;
        }

        .other-quizzes-card .oqc-grid {
            display: flex !important;
            flex-wrap: wrap !important;
            margin: -8px !important;
            padding: 0 !important;
            width: calc(100% + 16px) !important;
        }

        .other-quizzes-card .oqc-item-wrapper {
            flex: 0 0 50% !important;
            max-width: 50% !important;
            padding: 8px !important;
        }

        @media (max-width: 767px) {
            .other-quizzes-card .oqc-item-wrapper {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
        }

        .other-quizzes-card .oqc-item-link {
            text-decoration: none !important;
            display: block !important;
            width: 100% !important;
        }

        .other-quizzes-card .oqc-item {
            background: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            padding: 14px 18px !important;
            display: flex !important;
            align-items: center !important;
            gap: 14px !important;
            transition: all 0.25s ease !important;
            position: relative !important;
            width: 100% !important;
            text-align: left !important;
        }

        .other-quizzes-card .oqc-item:hover {
            border-color: #6366f1 !important;
            background: #ffffff !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.15) !important;
        }

        .other-quizzes-card .oqc-item.active-quiz {
            border-color: #f59e0b !important;
            background: #fffdf5 !important;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1) !important;
        }

        .other-quizzes-card .oqc-icon-box {
            width: 44px !important;
            height: 44px !important;
            border-radius: 10px !important;
            background: #e0e7ff !important;
            color: #4338ca !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            flex-shrink: 0 !important;
            transition: background 0.2s, color 0.2s !important;
        }

        .other-quizzes-card .oqc-item:hover .oqc-icon-box {
            background: #6366f1 !important;
            color: #ffffff !important;
        }

        .other-quizzes-card .oqc-item.active-quiz .oqc-icon-box {
            background: #fef3c7 !important;
            color: #d97706 !important;
        }

        .other-quizzes-card .oqc-content {
            flex: 1 !important;
            min-width: 0 !important;
            text-align: left !important;
        }

        .other-quizzes-card .oqc-item-title {
            font-size: 15px !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            margin: 0 0 3px 0 !important;
            display: block !important;
            transition: color 0.2s !important;
            line-height: 1.3 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            text-align: left !important;
        }

        .other-quizzes-card .oqc-item:hover .oqc-item-title {
            color: #4f46e5 !important;
        }

        .other-quizzes-card .oqc-item-count {
            font-size: 12px !important;
            color: #64748b !important;
            font-weight: 600 !important;
            display: flex !important;
            align-items: center !important;
            gap: 5px !important;
            text-align: left !important;
        }
    </style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">

            <div class="breadcrumbs-fs fl-wrap grey-blue-bg" style="border-bottom: 1px solid rgba(24, 60, 125, 0.2) !important; margin-bottom: 0 !important; padding-bottom: 12px !important; padding-top: 5px !important;">
                <div class="container" style="text-align: center;">
                    <h1 style="color:#183c7d; font-size:28px !important; font-weight:700 !important; margin:5px 0 5px 0; line-height:1.4; border:none !important;">
                        <span class="breadcrumb-title" style="font-size:28px !important; color:#183c7d !important; font-weight:700 !important; border-bottom:none !important;">{{ $type->type }} ({{ $quizzes->count() }})</span>
                    </h1>
                    @if($type->description)
                    <p style="font-size:17px; color:#334155; max-width:750px; margin:8px auto 0; line-height:1.6; font-weight:500;">
                        {{ $type->description }}
                    </p>
                    @endif
                </div>
            </div>

            <!-- section-->
            <section id="sec1" class="middle-padding grey-blue-bg">
                <div class="container">
                    <div class="row">
                        <!--blog content -->
                        <div class="col-md-8">
                            <!--post-container -->
                            <div class="post-container fl-wrap">
                                <!-- article> -->
                                <article class="post-article">
                                    <div class="list-single-main-item fl-wrap">

                                        <form>
                                            @include('frontend.pages.quiz.partials.quiz_markup')
                                        </form>
                                    </div>
                                </article>
                                <!-- article end -->
                            </div>
                            <!--post-container end -->

                            <!-- Other Quizzes Card -->
                            @php
                                $otherQuizTypes = App\Models\QuizType::whereHas('quizzes')->where('status', 1)->get();
                            @endphp
                            @if($otherQuizTypes->count() > 0)
                            <div style="background-color: #ffffff !important; border-radius: 16px !important; padding: 24px !important; margin-top: 30px !important; margin-bottom: 25px !important; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06) !important; clear: both !important; display: block !important; width: 100% !important; text-align: left !important; box-sizing: border-box !important;">
                                <div style="text-align: left !important; margin-bottom: 20px !important; padding-bottom: 14px !important; border-bottom: 2px solid #f1f5f9 !important; display: block !important; width: 100% !important; clear: both !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 10px !important; margin-bottom: 6px !important; text-align: left !important;">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; display: inline-block !important;"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                        <h3 style="font-size: 20px !important; font-weight: 800 !important; color: #0f172a !important; margin: 0 !important; border: none !important; padding: 0 !important; text-align: left !important; line-height: 1.3 !important; display: inline-block !important;">
                                            {{ __('Explore Other Quiz Topics') }}
                                        </h3>
                                    </div>
                                    <p style="font-size: 14px !important; color: #64748b !important; margin: 6px 0 0 0 !important; font-weight: 500 !important; text-align: left !important; line-height: 1.5 !important; display: block !important; clear: both !important; width: 100% !important;">
                                        {{ __('Test your programming skills and knowledge across all available quiz topics.') }}
                                    </p>
                                </div>
                                <div style="display: flex !important; flex-wrap: wrap !important; margin: -6px !important; padding: 0 !important; width: calc(100% + 12px) !important; box-sizing: border-box !important;">
                                    @foreach($otherQuizTypes as $otherType)
                                        @php $isActive = ($otherType->id == $type->id); @endphp
                                        <div style="flex: 0 0 50% !important; max-width: 50% !important; padding: 6px !important; box-sizing: border-box !important;">
                                            <a href="{{ route('quiz.tutorial', $otherType->slug) }}" style="text-decoration: none !important; display: block !important; width: 100% !important;">
                                                <div style="background-color: {{ $isActive ? '#fffdf5' : '#f8fafc' }} !important; border: 1.5px solid {{ $isActive ? '#f59e0b' : '#e2e8f0' }} !important; border-radius: 12px !important; padding: 14px 16px !important; display: flex !important; align-items: flex-start !important; gap: 12px !important; width: 100% !important; text-align: left !important; box-sizing: border-box !important;">
                                                    <div style="width: 40px !important; height: 40px !important; border-radius: 10px !important; background-color: {{ $isActive ? '#fef3c7' : '#e0e7ff' }} !important; display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0 !important; margin-top: 2px !important;">
                                                        @if($isActive)
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="display: block !important;"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                                                        @else
                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="display: block !important;"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                                                        @endif
                                                    </div>
                                                    <div style="flex: 1 !important; min-width: 0 !important; text-align: left !important;">
                                                        <div style="font-size: 14.5px !important; font-weight: 700 !important; color: #1e293b !important; margin: 0 0 4px 0 !important; display: block !important; line-height: 1.4 !important; text-align: left !important; word-break: break-word !important;">
                                                            {{ $otherType->type }}
                                                        </div>
                                                        <div style="font-size: 12px !important; color: #64748b !important; font-weight: 600 !important; display: flex !important; align-items: center !important; gap: 5px !important; text-align: left !important; margin: 0 !important;">
                                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block !important; flex-shrink:0;"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                            {{ $otherType->quizzes()->where('status', 1)->count() }} {{ __('Questions') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- blog content end -->
                        @include('frontend.pages.quiz.partials.sidebar')
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
    @include('frontend.pages.quiz.partials.quiz_js')
@endsection