@extends('backend.layouts.master')
@section('title','Contact Page Settings')
@section('style')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Contact Page Settings' />
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form method="post" action="{{ route('admin.settings.contact.page') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-7">
                            <!-- general form elements -->

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Contact Settings Details') }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <x-backend.v_error />
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="contact_info_title">{{ __('Contact Info Title') }}</label>
                                        <input type="text" class="form-control" name="contact_info_title" value="{{ get_static_option('contact_info_title') ?? '' }}" placeholder="{{ __('Contact info title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{ __('Address') }}</label>
                                        <input type="text" class="form-control" name="address" value="{{ get_static_option('address') ?? '' }}" placeholder="{{ __('Address') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{ __('Phone') }}</label>
                                        <input type="text" class="form-control" name="phone" value="{{ get_static_option('phone') ?? '' }}" placeholder="{{ __('Phone') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input type="text" class="form-control" name="email" value="{{ get_static_option('email') ?? '' }}" placeholder="{{ __('Email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="youtube">{{ __('Youtube') }}</label>
                                        <input type="text" class="form-control" name="youtube" value="{{ get_static_option('youtube') ?? '' }}" placeholder="{{ __('Youtube') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="facebook">{{ __('Facebook') }}</label>
                                        <input type="text" class="form-control" name="facebook" value="{{ get_static_option('facebook') ?? '' }}" placeholder="{{ __('Facebook') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin">{{ __('Linkedin') }}</label>
                                        <input type="text" class="form-control" name="linkedin" value="{{ get_static_option('linkedin') ?? '' }}" placeholder="{{ __('Linkedin') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="github">{{ __('Github') }}</label>
                                        <input type="text" class="form-control" name="github" value="{{ get_static_option('github') ?? '' }}" placeholder="{{ __('Github') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stackoverflow">{{ __('Stackoverflow') }}</label>
                                        <input type="text" class="form-control" name="stackoverflow" value="{{ get_static_option('stackoverflow') ?? '' }}" placeholder="{{ __('Stackoverflow') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_message_title">{{ __('Contact Message Title') }}</label>
                                        <input type="text" class="form-control" name="contact_message_title" value="{{ get_static_option('contact_message_title') }}" placeholder="{{ __('Contact message title') }}">
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


