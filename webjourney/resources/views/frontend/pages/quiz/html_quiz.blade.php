@extends('frontend.layouts.master')
@section('site_title'){{__('Webjourney')}} - {{ $type->type }} Quiz Test @endsection
@section('description',get_static_option('description'))
@section('og_url'){{ route('quiz.tutorial',$type->slug ) }} @endsection
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
    border: 1px solid rgba(99,102,241,0.22);
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
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
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.09);
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
    top: 0; left: 0; right: 0;
    background: #6366f1;
}
.qsd-cell-top.c-green  { background: linear-gradient(90deg, #22c55e, #16a34a); }
.qsd-cell-top.c-red    { background: linear-gradient(90deg, #ef4444, #dc2626); }
.qsd-cell-top.c-yellow { background: linear-gradient(90deg, #f59e0b, #d97706); }
.qsd-cell-top.c-blue   { background: linear-gradient(90deg, #3b82f6, #2563eb); }
.qsd-cell-top.c-purple { background: linear-gradient(90deg, #6366f1, #8b5cf6); }

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
    color: rgba(255,255,255,0.45);
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
    color: rgba(255,255,255,0.35);
    font-family: sans-serif;
}

/* Timer colour states */
#qsd-time-display.color-green  { color: #4ade80; }
#qsd-time-display.color-yellow { color: #fbbf24; }
#qsd-time-display.color-red    { color: #f87171; }

/* Danger pulse on timer card */
@keyframes qsd-danger-pulse {
    0%, 100% { border-color: rgba(239,68,68,0.3); }
    50%       { border-color: rgba(239,68,68,0.9); box-shadow: 0 0 0 4px rgba(239,68,68,0.15); }
}
.qsd-cell.danger-pulse { animation: qsd-danger-pulse 1s ease infinite; }

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
    color: rgba(255,255,255,0.4);
    font-family: sans-serif;
}
.qsd-pbar-meta-right { text-align: right; }
.qsd-pbar-track {
    display: block;
    height: 8px;
    background: rgba(255,255,255,0.08);
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
    -webkit-transition: width 0.45s cubic-bezier(0.4,0,0.2,1);
    transition: width 0.45s cubic-bezier(0.4,0,0.2,1);
}

/* ===== QUIZ QUESTION BLOCKS ===== */
.quiz-question-block {
    background: #fff;
    border-radius: 14px;
    padding: 20px 20px 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.07);
    border: 1.5px solid #e9ecef;
    -webkit-transition: box-shadow 0.3s ease;
    transition: box-shadow 0.3s ease;
    margin-bottom: 0;
}
.quiz-question-block:hover { box-shadow: 0 6px 22px rgba(0,0,0,0.11); }

.qq-header {
    display: table;
    width: 100%;
    margin-bottom: 14px;
}
.qq-number-cell {
    display: table-cell;
    vertical-align: top;
    width: 44px;
    padding-top: 1px;
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
}
.qq-title {
    font-size: 15.5px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.55;
    margin: 0;
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
.qq-option-label:last-child { margin-bottom: 0; }
.qq-option-label:hover:not(.disabled) {
    border-color: #6366f1;
    background: #f0f0ff;
    box-shadow: 2px 0 0 0 #6366f1 inset;
}
.qq-option-label input[type=radio] { display: none; }

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
}
.qq-option-text {
    font-size: 14px;
    font-weight: 500;
    color: #334155;
    line-height: 1.45;
    font-family: sans-serif;
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
.qq-option-label.option-correct .qq-option-check::before { content: '✓'; }

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
.qq-option-label.option-wrong .qq-option-check::before { content: '✗'; }

.qq-option-label.disabled { cursor: not-allowed !important; }

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
.answer-card.correct .answer-header { color: #15803d; }
.answer-card.wrong   .answer-header { color: #b91c1c; }
.answer-detail {
    font-size: 13px;
    color: #374151;
    line-height: 1.55;
    font-family: sans-serif;
}
.answer-detail strong { color: #183c7d; }
.answer-explanation {
    font-size: 12.5px;
    color: #4b5563;
    margin-top: 7px;
    padding-top: 7px;
    border-top: 1px dashed rgba(0,0,0,0.12);
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
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
    border: 1px solid rgba(99,102,241,0.2);
    clear: both;
}
.qrp-emoji  { font-size: 56px; display: block; margin-bottom: 8px; }
.qrp-title  { font-size: 26px; font-weight: 800; color: #f1f5f9; margin: 0 0 6px; font-family: sans-serif; }
.qrp-sub    { font-size: 14px; color: rgba(255,255,255,0.5); margin-bottom: 24px; font-family: sans-serif; }

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
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
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
.qrp-cell-val.c-red    { color: #f87171; }
.qrp-cell-val.c-yellow { color: #fbbf24; }
.qrp-cell-val.c-blue   { color: #60a5fa; font-size: 20px; }
.qrp-cell-lbl {
    display: block;
    font-size: 10px;
    color: rgba(255,255,255,0.38);
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
    box-shadow: 0 4px 14px rgba(99,102,241,0.4);
    font-family: sans-serif;
    display: inline-block;
}
.qrp-retry-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(99,102,241,0.5);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .qsd-cell-value { font-size: 15px; }
    .qsd-cell-icon  { font-size: 14px; }
    .qq-title       { font-size: 14px; }
    .qrp-cell-val   { font-size: 22px; }
}
</style>
@endsection

@section('content')
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">

             <x-frontend.dynamic-breadcrumb :title="$type->type . ' (' . $quizzes->count() . ')'" />
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
                                    <div class="list-single-main-item fl-wrap">

                                        <form>
                                            @include('frontend.pages.quiz.partials.quiz_markup')
                                        </form>
                                    </div>
                                </article>
                                <!-- article end -->
                            </div>
                            <!--post-container end -->
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
