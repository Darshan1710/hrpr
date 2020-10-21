@extends('layouts.backend.master')

@section('title')
    Job Application
@endsection

@push('styles')
    @include('admin.injector.admin-attriutes-injector')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin/datatables.min.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/js/admin/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $(document).on('click', "#delete-item", function() {
                $(this).addClass('delete-item-trigger-clicked');
                var options = {
                    'backdrop': 'static'
                };
                $('#delete-modal').modal(options)
                $("#delete-modal-label").text('Delete item?')
            })
            $(document).on('click', "#delete-action-confirm", function() {
                $('.delete-item-trigger-clicked').siblings("#delete-data-form").submit();
            })
            $('#delete-modal').on('hide.bs.modal', function() {
                $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
            })
        });

    </script>
@endpush

@section('page-content')
    <div class="main-container container-fluid">
        @include('layouts.backend.messages')
        <!-- heading -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="text-primary mr-auto">Job Application</h1>
                </div>
                {{-- <div class="col align-self-center">
                    <a href="{{ route('admin.application.create') }}" class="btn btn-outline-primary pull-right">Create
                        New</a>
                </div> --}}
            </div>
        </div>
        <!-- /heading -->
        <!-- table -->
        <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Job Sector</th>
                    <th>CV</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($jobApplicationList->isNotEmpty())
                    @foreach ($jobApplicationList as $item)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $item->category }}</td>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->phone }}</td>
                            <td class="align-middle">{{ $item->email }}</td>
                            <td class="align-middle">{{ $item->job_sector }}</td>
                            <td class="align-middle">
                                <a href="{{asset("assets/files/cv_files/". $item->file_path)}}" download>CV</a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('admin.application.edit', $item->id) }}" class="btn btn-primary"><i
                                        class="fa fa-edit"></i> View</a>
                                <form method="POST" id="delete-data-form"
                                    action="{{ route('admin.application.destroy', $item->id) }}" hidden>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <button type="button" class="btn btn-danger" id="delete-item"><i class="fa fa-trash-o"></i>
                                    Completed</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- /table -->
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <h4 class="text-center">Are you sure you want to delete this item?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" id="delete-action-confirm" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
@endsection
