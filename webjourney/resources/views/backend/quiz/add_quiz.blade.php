@extends('backend.layouts.master')
@section('title','Add Quiz')
@section('style')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Add Quiz' />
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form method="post" action="{{ route('admin.add.quiz') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <textarea class="form-control" name="title" id="title" data-sample-preservewhitespace rows="3" placeholder="{{ __('Description') }}">{{ old('description') }}</textarea>

                        </div>
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Quiz Details') }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <x-backend.v_error />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="quiz_type_id">{{ __('Type') }}</label>
                                        <select class="form-control" name="quiz_type_id" id="quiz_type_id">
                                            <option value="">{{ __('Select Type') }}</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="correct_answer">{{ __('Correct Answer') }}</label>
                                        <input type="text" class="form-control" name="correct_answer" id="correct_answer" value="{{ old('correct_answer') }}" placeholder="{{ __('Quiz Answer') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="explanation">{{ __('Explanation') }} <small class="text-muted">(Optional — shown after user answers)</small></label>
                                        <textarea class="form-control" name="explanation" id="explanation" rows="4" placeholder="{{ __('Explain why the correct answer is right...') }}">{{ old('explanation') }}</textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                                <!-- /.card-footer -->

                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">
                            <!-- Form Element sizes -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Quiz Options') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="option_a">{{ __('Option A') }}</label>
                                        <input type="text" class="form-control" name="option_a" id="option_a" value="{{ old('option_a') }}" placeholder="{{ __('Option A') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="option_b">{{ __('Option B') }}</label>
                                        <input type="text" class="form-control" name="option_b" id="option_b" value="{{ old('option_b') }}" placeholder="{{ __('Option B') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="option_c">{{ __('Option C') }}</label>
                                        <input type="text" class="form-control" name="option_c" id="option_c" value="{{ old('option_c') }}" placeholder="{{ __('Option C') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="option_d">{{ __('Option D') }}</label>
                                        <input type="text" class="form-control" name="option_d" id="option_d" value="{{ old('option_d') }}" placeholder="{{ __('Option D') }}">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (right) -->
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
    <script>
        $(document).ready(function() {
            var config = {
                extraPlugins: 'codesnippet',
                codeSnippet_theme: 'monokai_sublime',
                height: 200,
                removeButtons: 'PasteFromWord',
            };
            CKEDITOR.replace('title', config);
        });
    </script>
@endsection


