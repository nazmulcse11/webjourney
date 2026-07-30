@extends('backend.layouts.master')
@section('title','Edit Post')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Edit Post' />
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form method="post" action="{{ route('admin.edit.post',$post->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-7">
                            <!-- general form elements -->

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Post Details') }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <x-backend.v_error />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}" placeholder="{{ __('Post Title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('Slug') }}</label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $post->slug }}" placeholder="{{ __('Post Slug') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('Meta Title') }}</label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $post->meta_title }}" placeholder="{{ __('Meta Title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Meta Description') }}</label>
                                        <textarea class="form-control" name="meta_description" id="meta_description" placeholder="{{ __('Meta Description') }}">{{ $post->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{ __('Post Image') }}</label>
                                        <br>
                                        <img src="{{ asset('images/post/'.$post->image) }}" alt="post-image" style="width:150px;margin:10px 0px;">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="image">
                                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{ __('Upload') }}</span>
                                            </div>
                                        </div>
                                        <small>{{ __('Recommended size: 668x445') }}</small>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-5">
                            <!-- Form Element sizes -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Post Catalogue') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="e_slug">{{ __('Category') }}</label>
                                        <select class="select2 form-control" multiple="multiple" data-placeholder="Select Category" name="category[]" id="category">
                                            @foreach($categories as $category)
                                                <option
                                                    @foreach($post->categories as $post_cat)
                                                        {{ $post_cat->id == $category->id ? 'selected' : '' }}
                                                    @endforeach
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subcategory_id">{{ __('Subcategory') }}</label>
                                        <select class="select2 form-control" multiple="multiple" data-placeholder="Select Sub Category" name="subcategory[]" id="subcategory[]">
                                            @foreach($sub_categories as $sub_cat)
                                                <option
                                                    @foreach($post->sub_categories as $post_sub_cat)
                                                        {{ $post_sub_cat->id == $sub_cat->id ? 'selected' : ''}}
                                                    @endforeach
                                                    value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tag_id">{{ __('Tags') }}</label>
                                        <select class="select2 form-control" multiple="multiple" data-placeholder="Select Tag" name="tag[]" id="tag[]">
                                            @foreach($tags as $tag)
                                                <option
                                                    @foreach($post->tags as $post_tag)
                                                        {{ $post_tag->id == $tag->id ? 'selected' : ''}}
                                                    @endforeach
                                                    value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{ __('Status') }}</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option @if($post->status=='publish') selected @endif value="{{ __('publish') }}">{{ __('Publish') }}</option>
                                            <option @if($post->status=='draft') selected @endif value="{{ __('draft') }}">{{ __('Draft') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="video">{{ __('Video') }}</label>
                                        <textarea class="form-control" name="video" id="video" placeholder="{{ __('Video Url') }}">{{ $post->video }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">{{ __('Type') }}</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">{{ __('Select Type') }}</option>
                                            <option @if($post->type=='post') selected @endif  value="{{ __('post') }}">{{ __('Post') }}</option>
                                            <option @if($post->type=='quiz') selected @endif  value="{{ __('quiz') }}">{{ __('Quiz') }}</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Post Description') }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="{{ __('Description') }}">{{ $post->description }}</textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>

                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </form>
                <!-- /.form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/4.19.0/standard-all/ckeditor.js"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select2 -->
    <script>
        $(document).ready(function() {
            var config = {
                extraPlugins: 'codesnippet,justify',
                codeSnippet_theme: 'monokai_sublime',
                height: 356,
                removeButtons: 'PasteFromWord',
            };
            CKEDITOR.replace('description', config);

            $('.select2').select2()
        });
    </script>
@endsection


