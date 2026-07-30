@extends('backend.layouts.master')
@section('title','Post Comments')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <x-backend.breadcrumb data='Comments' />
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
                                <h3 class="card-title">{{ __('All Comments') }}</h3>
                                <a style="float:right" class="btn btn-info btn-sm" href="{{ route('admin.add.post') }}">
                                    <i class="fas fa-plus-circle"></i> {{ __('Add Post') }}
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <x-backend.v_error />
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Comment') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Post') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>
                                                @if($comment->status == 1)
                                                    <span class="btn btn-primary btn-sm m-1"> {{ __('Approve') }}</span>
                                                @else
                                                    <span class="btn btn-danger btn-sm m-1"> {{ __('Pending') }}</span>
                                                @endif
                                                <x-backend.status_change :url="route('admin.status.comment',$comment->id)" />
                                            </td>
                                            <td>{{ optional($comment->post)->title }}</td>
                                            <td>
                                                <x-backend.delete_popup :url="route('admin.delete.comment',$comment->id)" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Comment') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Post') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </tfoot>
                                </table>

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
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            //delete comment
            $(document).on('click','.swal_delete_btn',function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            })

            //change comment status
            $(document).on('click','.swal_status_btn',function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            })

        });
    </script>
@endsection
