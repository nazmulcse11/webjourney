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
                                        <img src="{{ !empty($post->image) ? asset('images/post/'.$post->image) : asset('frontend/images/default-post-668x445.png') }}" alt="post-image" style="width:150px;margin:10px 0px;">
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

                                    <hr class="my-4">

                                    <!-- FAQ Builder Section -->
                                    @php
                                        $existingFaqs = is_array($post->faqs) ? $post->faqs : (is_string($post->faqs) ? json_decode($post->faqs, true) : []);
                                        if (empty($existingFaqs)) {
                                            $existingFaqs = [['question' => '', 'answer' => '']];
                                        }
                                    @endphp
                                    <div class="faq-builder-wrapper">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5 class="mb-0 font-weight-bold text-primary">
                                                    <i class="fas fa-question-circle mr-1"></i> {{ __('Frequently Asked Questions (FAQ - Optional for Google Rich Snippets)') }}
                                                </h5>
                                                <small class="text-muted">{{ __('Add common questions and answers related to this tutorial. These automatically generate Google FAQPage Schema and a frontend FAQ section.') }}</small>
                                            </div>
                                            <button type="button" class="btn btn-success btn-sm" id="add_faq_item_btn">
                                                <i class="fas fa-plus mr-1"></i> {{ __('Add FAQ') }}
                                            </button>
                                        </div>

                                        <div id="faq_items_container">
                                            @foreach($existingFaqs as $index => $faqItem)
                                                <div class="card card-outline card-secondary mb-3 faq-item-row">
                                                    <div class="card-body py-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="badge badge-primary faq-number-badge">FAQ #{{ $index + 1 }}</span>
                                                            <button type="button" class="btn btn-outline-danger btn-xs remove-faq-item">
                                                                <i class="fas fa-trash-alt"></i> {{ __('Remove') }}
                                                            </button>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="mb-1">{{ __('Question') }}</label>
                                                            <input type="text" class="form-control" name="faq_questions[]" value="{{ $faqItem['question'] ?? '' }}" placeholder="{{ __('e.g. Is PhpStorm EAP legal to use for free?') }}">
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label class="mb-1">{{ __('Answer') }}</label>
                                                            <textarea class="form-control" name="faq_answers[]" rows="2" placeholder="{{ __('Write a clear, direct answer (2-4 sentences recommended)...') }}">{{ $faqItem['answer'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /FAQ Builder Section -->
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

            $('.select2').select2();

            function renumberFaqBadges() {
                $('#faq_items_container .faq-item-row').each(function(idx) {
                    $(this).find('.faq-number-badge').text('FAQ #' + (idx + 1));
                });
            }

            $('#add_faq_item_btn').on('click', function() {
                var count = $('#faq_items_container .faq-item-row').length + 1;
                var rowHtml = `
                    <div class="card card-outline card-secondary mb-3 faq-item-row">
                        <div class="card-body py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge badge-primary faq-number-badge">FAQ #${count}</span>
                                <button type="button" class="btn btn-outline-danger btn-xs remove-faq-item">
                                    <i class="fas fa-trash-alt"></i> {{ __('Remove') }}
                                </button>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-1">{{ __('Question') }}</label>
                                <input type="text" class="form-control" name="faq_questions[]" placeholder="{{ __('e.g. Enter FAQ question...') }}">
                            </div>
                            <div class="form-group mb-0">
                                <label class="mb-1">{{ __('Answer') }}</label>
                                <textarea class="form-control" name="faq_answers[]" rows="2" placeholder="{{ __('Write a clear, direct answer...') }}"></textarea>
                            </div>
                        </div>
                    </div>`;
                $('#faq_items_container').append(rowHtml);
            });

            $(document).on('click', '.remove-faq-item', function() {
                if ($('#faq_items_container .faq-item-row').length > 1) {
                    $(this).closest('.faq-item-row').remove();
                    renumberFaqBadges();
                } else {
                    $(this).closest('.faq-item-row').find('input, textarea').val('');
                }
            });
        });
    </script>
@endsection


