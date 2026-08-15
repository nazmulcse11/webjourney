@php $totalQuizzes = $quizzes->count(); @endphp

{{-- ===== QUIZ STATS DASHBOARD ===== --}}
<div id="quiz-stats-dashboard">

    {{-- Stats Row (table-cell layout for theme compatibility) --}}
    <div class="qsd-row">
        {{-- Timer --}}
        <div class="qsd-cell" id="qsd-timer-card">
            <span class="qsd-cell-top c-green"></span>
            <span class="qsd-cell-icon">⏱️</span>
            <span class="qsd-cell-label">Time Left</span>
            <span class="qsd-cell-value" id="qsd-time-display">--:--</span>
        </div>
        {{-- Score --}}
        <div class="qsd-cell">
            <span class="qsd-cell-top c-purple"></span>
            <span class="qsd-cell-icon">🏆</span>
            <span class="qsd-cell-label">Score</span>
            <span class="qsd-cell-value"><span id="qsd-correct">0</span><sup>/{{ $totalQuizzes }}</sup></span>
        </div>
        {{-- Wrong --}}
        <div class="qsd-cell">
            <span class="qsd-cell-top c-red"></span>
            <span class="qsd-cell-icon">❌</span>
            <span class="qsd-cell-label">Wrong</span>
            <span class="qsd-cell-value"><span id="qsd-wrong">0</span><sup>/{{ $totalQuizzes }}</sup></span>
        </div>
        {{-- Accuracy --}}
        <div class="qsd-cell">
            <span class="qsd-cell-top c-yellow"></span>
            <span class="qsd-cell-icon">🎯</span>
            <span class="qsd-cell-label">Accuracy</span>
            <span class="qsd-cell-value"><span id="qsd-accuracy">-</span></span>
        </div>
        {{-- Answered --}}
        <div class="qsd-cell">
            <span class="qsd-cell-top c-blue"></span>
            <span class="qsd-cell-icon">📊</span>
            <span class="qsd-cell-label">Answered</span>
            <span class="qsd-cell-value"><span id="qsd-answered">0</span><sup>/{{ $totalQuizzes }}</sup></span>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="qsd-pbar-wrap">
        <div class="qsd-pbar-meta">
            <span class="qsd-pbar-meta-left">Overall Progress</span>
            <span class="qsd-pbar-meta-right" id="qsd-progress-pct">0%</span>
        </div>
        <div class="qsd-pbar-track">
            <span class="qsd-pbar-fill" id="qsd-progress-fill"></span>
        </div>
    </div>

</div>
{{-- ===== END STATS DASHBOARD ===== --}}


{{-- ===== QUIZ QUESTIONS ===== --}}
@foreach($quizzes as $key => $quiz)
    @php $key = $key + 1; @endphp

    <div class="quiz-question-block" id="qq-block-{{ $quiz->id }}" data-quiz-id="{{ $quiz->id }}">

        {{-- Question Header (table layout) --}}
        <div class="qq-header">
            <div class="qq-number-cell"><span class="qq-number">Q{{ $key }}</span></div>
            <div class="qq-title-cell">
                <div class="qq-title">
                    {!! strip_tags($quiz->title, '<code><pre><strong><em><b><i><img><a><br><span>') !!}
                </div>
            </div>
        </div>

        {{-- Options (table layout per option) --}}
        <div class="qq-options" id="qq-options-{{ $quiz->id }}">
            @foreach(['a' => $quiz->option_a, 'b' => $quiz->option_b, 'c' => $quiz->option_c, 'd' => $quiz->option_d] as $letter => $option)
                <label class="qq-option-label" for="opt_{{ $quiz->id }}_{{ $letter }}">
                    <input
                        class="quiz-answer choose-answer"
                        id="opt_{{ $quiz->id }}_{{ $letter }}"
                        data-quiz_id="{{ $quiz->id }}"
                        type="radio"
                        name="answer_{{ $quiz->id }}"
                        value="{{ $option }}"
                    >
                    <span class="qq-opt-letter-cell"><span class="qq-option-letter">{{ strtoupper($letter) }}</span></span>
                    <span class="qq-opt-text-cell"><span class="qq-option-text">{{ $option }}</span></span>
                    <span class="qq-opt-check-cell"><span class="qq-option-check"></span></span>
                </label>
            @endforeach
        </div>

        {{-- Answer Feedback Block --}}
        <div class="answer-block" id="answer_block_{{ $quiz->id }}">
            <span class="error-answer-{{ $quiz->id }}"></span>
            <span class="show-answer-{{ $quiz->id }}"></span>
        </div>

    </div>

    @if(!$loop->last)
        <div class="quiz-separator"></div>
    @endif
@endforeach

{{-- ===== RESULT PANEL ===== --}}
<div id="quiz-result-panel" style="display:none;">
    <div class="qrp-emoji" id="qrp-emoji">🎉</div>
    <h2 class="qrp-title" id="qrp-title">Quiz Complete!</h2>
    <p class="qrp-sub" id="qrp-subtitle"></p>
    <div class="qrp-row">
        <div class="qrp-cell"><span class="qrp-cell-val" id="qrp-score">0</span><span class="qrp-cell-lbl">Score</span></div>
        <div class="qrp-cell"><span class="qrp-cell-val c-red" id="qrp-wrong">0</span><span class="qrp-cell-lbl">Wrong</span></div>
        <div class="qrp-cell"><span class="qrp-cell-val c-yellow" id="qrp-acc">0%</span><span class="qrp-cell-lbl">Accuracy</span></div>
        <div class="qrp-cell"><span class="qrp-cell-val c-blue" id="qrp-time">--</span><span class="qrp-cell-lbl">Time</span></div>
    </div>
    <button class="qrp-retry-btn" onclick="location.reload()">🔄 Try Again</button>
</div>
