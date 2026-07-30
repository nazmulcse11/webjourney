@extends('backend.layouts.master')
@section('title','Sub Category')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Sub Category' />
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
                                <h3 class="card-title">{{ __('All Sub Categories') }}</h3>
                                <a style="float:right" class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#addSubCategoryModal">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add Sub Category') }}
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <x-backend.v_error />
                            <div class="card-body">
                                @include('backend.subcategory.sub_category_table')
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

    @include('backend.subcategory.add_sub_category_modal')
    @include('backend.subcategory.edit_sub_category_modal')
    @include('backend.subcategory.sub_category_js')

@endsection
