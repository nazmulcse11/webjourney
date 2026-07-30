@foreach($quizzes as $key=>$quiz)
    @php $key = $key+1 @endphp
    <div class="list-single-main-item-title fl-wrap">
        <h3>{!! $key.'. '.$quiz->title !!} </h3>
    </div>
    <p>
        <input
            style="cursor:pointer;transform: scale(1.3);margin-right:10px;"
            class="quiz-answer choose-answer"
            data-quiz_id="{{ $quiz->id }}"
            type="radio"
            name="answer" value="{{ $quiz->option_a }}">
        {{ $quiz->option_a }}<br>
    </p>
    <p>
        <input
            style="cursor:pointer;transform: scale(1.3);margin-right:10px;"
            class="quiz-answer choose-answer"
            data-quiz_id="{{ $quiz->id }}"
            type="radio"
            name="answer" value="{{ $quiz->option_b }}">
        {{ $quiz->option_b }} <br>
    </p>
    <p>
        <input
            style="cursor:pointer;transform: scale(1.3);margin-right:10px;"
            class="quiz-answer choose-answer"
            data-quiz_id="{{ $quiz->id }}"
            type="radio"
            name="answer" value="{{ $quiz->option_c }}">
        {{ $quiz->option_c }} <br>
    </p>
    <p>
        <input
            style="cursor:pointer;transform: scale(1.3);margin-right:10px;"
            class="quiz-answer choose-answer"
            data-quiz_id="{{ $quiz->id }}"
            type="radio"
            name="answer" value="{{ $quiz->option_d }}">
        {{ $quiz->option_d }} <br>
    </p>
    <br>
    <p class="answer-block" id="answer_block_{{ $quiz->id }}">
        <span class="error-answer-{{ $quiz->id }}"></span> <br>
        <span class="show-answer-{{ $quiz->id }}"></span>
    </p>
    <span class="fw-separator"></span>
@endforeach
