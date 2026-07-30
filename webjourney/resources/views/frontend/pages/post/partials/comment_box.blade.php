@if(Auth::check())
    <div class="list-single-main-item fl-wrap" id="sec6">
        <div class="list-single-main-item-title fl-wrap">
            <h3>{{ __('Add Review') }}</h3> <br>
        </div>
        <p class="comment_error_message"></p>
        <!-- Add Review Box -->
        <div id="add-review" class="add-review-box">
            <!-- Review Comment -->
            <form id="add-comment" action="{{ route('add.comment') }}" method="post" class="add-comment custom-form" name="rangeCalc" >
                @csrf
                <fieldset>
                    <textarea name="comment" id="comment_text" rows="2" placeholder="Your Review:">{{ old('comment') }}</textarea>
                    <input type="hidden" name="post_id" value="{{ $post_details->id }}" />
                </fieldset>
                <button class="btn no-shdow-btn float-btn color2-bg submit_your_comment" style="margin-top:30px">{{ __('Submit Comment') }}<i class="fal fa-paper-plane"></i></button>
            </form>
        </div>
        <!-- Add Review Box / End -->
    </div>
@else
    <div class="list-single-main-item fl-wrap">
        <div class="add-comment custom-form">
            <button class="btn no-shdow-btn float-btn color2-bg modal-open">{{ __('Sign In') }}<i class="fal fa-paper-plane"></i></button>
        </div>
    </div>
@endif
