@extends('backend.layouts.master')
@section('title','Post')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Post' />
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('All Posts') }}</h3>
                                <a style="float:right" class="btn btn-info btn-sm" href="{{ route('admin.add.post') }}">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add Post') }}
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <x-backend.v_error />
                            <div class="card-body">
                                @include('backend.post.post_table')
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('backend.category.category_js')

@endsection
