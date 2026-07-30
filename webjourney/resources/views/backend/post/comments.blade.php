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
                                        <th>{{ __('Reply') }}</th>
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
                                                @if($comment->replies->count() >= 1)
                                                    <span class="btn btn-info btn-sm m-1">{{ __('Yes') }}</span>
                                                @else
                                                    <span class="btn btn-danger btn-sm m-1">{{ __('No') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <x-backend.delete_popup :url="route('admin.delete.comment',$comment->id)" />
                                                <a
                                                    class="btn btn-info btn-sm m-1 comment_reply_modal_btn"
                                                    href="#" data-toggle="modal"
                                                    data-target="#commentReplyModal"
                                                    data-comment_id="{{ $comment->id }}"
                                                >
                                                    <i class="fas fa-reply"></i>
                                                </a>
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
                                        <th>{{ __('Reply') }}</th>
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
    @include('backend.post.comment_reply_modal')
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

            //comment reply
            $(document).on('click','.comment_reply_modal_btn',function(){
                let comment_id = $(this).data('comment_id');
                $('#comment_id').val(comment_id);
            });

        });
    </script>
@endsection
