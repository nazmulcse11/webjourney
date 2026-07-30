<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Add New Category') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="{{ route('admin.add.category') }}" method="post" enctype="multipart/form-data" id="addCategoryForm">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('Enter Category') }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">{{ __('Slug') }}</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="{{ __('Enter Slug') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">{{ __('Image') }}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
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
