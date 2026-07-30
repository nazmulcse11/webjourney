<div class="modal fade" id="editTagModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Tag') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="{{ route('admin.edit.tag') }}" method="post" enctype="multipart/form-data" id="addCategoryForm">
                @csrf
                <input type="hidden" name="e_id" id="e_id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="e_name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="e_name" id="e_name" value="" placeholder="{{ __('Enter Category') }}">
                        </div>
                        <div class="form-group">
                            <label for="e_slug">{{ __('Slug') }}</label>
                            <input type="text" class="form-control" name="e_slug" id="e_slug" value="" placeholder="{{ __('Enter Slug') }}">
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
