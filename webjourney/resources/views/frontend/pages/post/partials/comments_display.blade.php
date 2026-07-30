@foreach($comments as $comment)
    <div class="reviews-comments-item">
        <div class="review-comments-avatar"></div>
            <div class="reviews-comments-item-text">
            <h4>
                <i style="font-size:40px;" class="fas fa-user-circle"></i>
                <a style="bottom: 9px;" href="#">{{ $comment->user->name }}</a>
            </h4>
            <div class="clearfix"></div>
            <p>
                {{ $comment->comment }}
               <p><small><i class="fal fa-calendar-check"></i> {{ $comment->created_at->toFormattedDateString() }}</small></p>
            </p>
            @foreach($comment->replies as $reply)
                <h4>
                    <i style="font-size:40px;color:orange; margin-top:30px" class="fas fa-user-circle"></i>
                    <a style="bottom: 9px;" href="#">{{ __('WebJourney') }}</a>
                </h4>
                <div class="clearfix"></div>
                <p>
                {{ $reply->reply }}
                <p><small><i class="fal fa-calendar-check"></i> {{ $reply->created_at->toFormattedDateString() }}</small></p>
                </p>
            @endforeach
        </div>
    </div>
@endforeach
