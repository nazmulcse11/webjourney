<script>
$(document).ready(function () {

    // ── CONFIG ──
    var TOTAL       = {{ $quizzes->count() }};
    var SECONDS     = TOTAL * 30;
    var timeLeft    = SECONDS;
    var timerInterval;
    var correct     = 0;
    var wrong       = 0;
    var answered    = 0;
    var started     = false;
    var timeUsed    = 0;

    // ── TIMER ──
    function formatTime(sec) {
        var m = Math.floor(sec / 60).toString();
        var s = (sec % 60).toString();
        if (m.length < 2) m = '0' + m;
        if (s.length < 2) s = '0' + s;
        return m + ':' + s;
    }

    function startTimer() {
        if (started) return;
        started = true;
        $('#qsd-time-display').text(formatTime(timeLeft));
        timerInterval = setInterval(function () {
            timeLeft--;
            timeUsed++;
            if (timeLeft <= 0) {
                timeLeft = 0;
                clearInterval(timerInterval);
                showResultPanel(true);
            }
            updateTimerUI();
        }, 1000);
    }

    function updateTimerUI() {
        var $el = $('#qsd-time-display');
        $el.text(formatTime(timeLeft));

        var pct = (timeLeft / SECONDS) * 100;

        // color shift: green → yellow → red
        $el.removeClass('color-green color-yellow color-red');
        if (pct > 50) $el.addClass('color-green');
        else if (pct > 25) $el.addClass('color-yellow');
        else $el.addClass('color-red');

        // danger pulse when < 30s
        if (timeLeft <= 30) {
            $('#qsd-timer-card').addClass('danger-pulse');
        }
    }

    // ── STATS UPDATE ──
    function updateStats() {
        $('#qsd-correct').text(correct);
        $('#qsd-wrong').text(wrong);
        $('#qsd-answered').text(answered);

        var pct = TOTAL > 0 ? Math.round((answered / TOTAL) * 100) : 0;
        $('#qsd-progress-fill').css('width', pct + '%');
        $('#qsd-progress-pct').text(pct + '%');

        // Accuracy
        if (answered > 0) {
            var acc = Math.round((correct / answered) * 100);
            $('#qsd-accuracy').text(acc + '%');
            if (acc >= 80) $('#qsd-accuracy').css('color', '#4ade80');
            else if (acc >= 50) $('#qsd-accuracy').css('color', '#fbbf24');
            else $('#qsd-accuracy').css('color', '#f87171');
        } else {
            $('#qsd-accuracy').text('-').css('color', '');
        }

        // All answered?
        if (answered === TOTAL) {
            clearInterval(timerInterval);
            setTimeout(function () { showResultPanel(false); }, 800);
        }
    }

    // ── RESULT PANEL ──
    function showResultPanel(timesUp) {
        var acc = answered > 0 ? Math.round((correct / answered) * 100) : 0;
        var used = formatTime(timeUsed);

        var emoji, title, subtitle;
        if (timesUp) {
            emoji = '⏰'; title = "Time's Up!"; subtitle = 'You ran out of time. Keep practicing!';
        } else if (acc === 100) {
            emoji = '🏆'; title = 'Perfect Score!'; subtitle = 'Outstanding! You got every question right!';
        } else if (acc >= 80) {
            emoji = '🎉'; title = 'Excellent Work!'; subtitle = 'Great job! You really know your stuff.';
        } else if (acc >= 60) {
            emoji = '👍'; title = 'Good Effort!'; subtitle = "Not bad! A little more practice and you'll ace it.";
        } else {
            emoji = '📚'; title = 'Keep Practicing!'; subtitle = "Don't give up — review the topics and try again.";
        }

        $('#qrp-emoji').text(emoji);
        $('#qrp-title').text(title);
        $('#qrp-subtitle').text(subtitle);
        $('#qrp-score').text(correct);
        $('#qrp-wrong').text(wrong);
        $('#qrp-acc').text(acc + '%');
        $('#qrp-time').text(used);

        $('#quiz-result-panel').fadeIn(600);
        $('html, body').animate({ scrollTop: $('#quiz-result-panel').offset().top - 100 }, 800);
    }

    // ── ANSWER CHECK ──
    $(document).on('change', '.quiz-answer', function (e) {
        e.preventDefault();

        // Start timer on first answer
        startTimer();

        var quiz_id       = $(this).data('quiz_id');
        var choose_answer = $(this).val();
        var answer_block  = '#answer_block_' + quiz_id;
        var $opts         = $('#qq-options-' + quiz_id);

        // Disable all options for this question
        $opts.find('input[type=radio]').prop('disabled', true);
        $opts.find('.qq-option-label').addClass('disabled');

        // Track if already answered
        var $block = $(this).closest('.quiz-question-block');
        if (!$block.data('answered')) {
            $block.data('answered', true);
            answered++;
        }

        $.ajax({
            url: "{{ route('quiz.answer.check') }}",
            method: 'GET',
            data: { quiz_id: quiz_id, choose_answer: choose_answer },
            success: function (res) {

                // Find the selected label by matching input value
                var $selected = null;
                $opts.find('.qq-option-label').each(function () {
                    if ($(this).find('input').val() === choose_answer) {
                        $selected = $(this);
                    }
                });

                var explanation = res.explanation
                    ? '<div class="answer-explanation">💡 ' + res.explanation + '</div>'
                    : '';

                if (res.status === 'success') {
                    correct++;
                    if ($selected) $selected.addClass('option-correct');
                    $(answer_block).html(
                        '<div class="answer-card correct">' +
                            '<div class="answer-header">✅ Correct Answer!</div>' +
                            '<div class="answer-detail">Your selected answer is correct.</div>' +
                            explanation +
                        '</div>'
                    ).slideDown(250);
                }

                if (res.status === 'wrong') {
                    wrong++;
                    if ($selected) $selected.addClass('option-wrong');
                    // Highlight the correct one
                    $opts.find('.qq-option-label').each(function () {
                        if ($(this).find('input').val() === res.correct_answer) {
                            $(this).addClass('option-correct');
                        }
                    });
                    $(answer_block).html(
                        '<div class="answer-card wrong">' +
                            '<div class="answer-header">❌ Wrong Answer</div>' +
                            '<div class="answer-detail">Correct Answer: <strong>' + res.correct_answer + '</strong></div>' +
                            explanation +
                        '</div>'
                    ).slideDown(250);
                }

                updateStats();
            }
        });
    });

    // ── INIT ──
    updateStats();
    $('#qsd-time-display').text(formatTime(timeLeft)).addClass('color-green');

});
</script>
