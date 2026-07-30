@extends('backend.layouts.master')
@section('title','Home Page Settings')
@section('style')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Home Page Settings' />
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form method="post" action="{{ route('admin.settings.home.page') }}">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-7">
                            <!-- general form elements -->

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Home Settings Details') }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <x-backend.v_error />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="keywords">{{ __('Keywords') }}</label>
                                        <textarea class="form-control" name="keywords" rows="5" placeholder="{{ __('Enter keywords') }}">{{ get_static_option('keywords') ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea class="form-control" name="description" rows="5" placeholder="{{ __('Enter description') }}">{{ get_static_option('description') ?? '' }}</textarea>
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
@endsection


