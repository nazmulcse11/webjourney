<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Category') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="{{ route('admin.edit.category') }}" method="post" enctype="multipart/form-data" id="addCategoryForm">
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
                        <div class="form-group">
                            <label for="exampleInputFile">{{ __('Image') }}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="e_image" id="e_image">
                                    <label class="custom-file-label" for="e_image">{{ __('Choose file') }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ __('Upload') }}</span>
                                </div>
                            </div>
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
