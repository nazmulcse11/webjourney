<div class="modal fade" id="commentReplyModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Reply to review') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="{{ route('admin.reply.comment') }}" method="post">
                @csrf
                <input type="hidden" name="comment_id" id="comment_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="reply">{{ __('Reply to review') }}</label>
                            <textarea class="form-control" name="reply" id="reply" rows="4" placeholder="{{ __('Enter reply') }}"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
