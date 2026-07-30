@extends('backend.layouts.master')
@section('title','Add Type')
@section('style')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Add Type' />
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form method="post" action="{{ route('admin.add.type') }}">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Type Details') }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <x-backend.v_error />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">{{ __('Quiz Type') }}</label>
                                        <input type="text" class="form-control" name="type" id="type" value="{{ old('type') }}" placeholder="{{ __('Type') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{ __('Slug') }}</label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" placeholder="{{ __('Slug') }}">
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
    <script>
        $(document).ready(function() {
            $(document).on('keyup','#type',function(){
                let type = $(this).val();
                type = type.toLowerCase();
                type = type.replace(/[^a-zA-Z0-9]+/g,'-');
                $("#slug").val(type);
            });
        });
    </script>
@endsection


