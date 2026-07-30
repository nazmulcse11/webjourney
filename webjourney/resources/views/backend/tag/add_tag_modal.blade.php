<div class="modal fade" id="addTagModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Add New Tag') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="{{ route('admin.add.tag') }}" method="post" enctype="multipart/form-data" id="addCategoryForm">
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
