@extends('layouts.backend.master')

@section('title')
    Job Opening - Inactive
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

            // for showing restore item popup
            $(document).on('click', "#restore-item", function() {
                $(this).addClass('restore-item-trigger-clicked');

                var options = {
                    'backdrop': 'static'
                };
                $('#restore-modal').modal(options)
                $("#restore-modal-label").text('Restore item?')
            })

            // on click of confirmation
            $(document).on('click', "#restore-action-confirm", function() {
                $('.restore-item-trigger-clicked').siblings("#restore-data-form").submit();
            })

            //  on modal hide
            $('#restore-modal').on('hide.bs.modal', function() {
                $('.restore-item-trigger-clicked').removeClass('restore-item-trigger-clicked')
            })
        })

    </script>
@endpush

@section('page-content')
    <div class="main-container container-fluid">
        @include('layouts.backend.messages')
        <!-- heading -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="text-primary mr-auto">Inactive Jobs</h1>
                </div>
            </div>
        </div>
        <!-- /heading -->
        <!-- table -->
        <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
                    <th>Category</th>
                    <th>Discription</th>
                    <th>Skillset</th>
                    <th>Location</th>
                    <th>Experience</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($jobOpeningList->isNotEmpty())
                    @foreach ($jobOpeningList as $item)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $item->job_title }}</td>
                            <td class="align-middle">{{ $item->category }}</td>
                            <td class="align-middle">{{ $item->description }}</td>
                            <td class="align-middle">{{ $item->skillset }}</td>
                            <td class="align-middle">{{ $item->location }}</td>
                            <td class="align-middle">{{ $item->required_experience }}</td>
                            <td class="align-middle">
                                <form method="POST" id="restore-data-form"
                                    action="{{ route('admin.jobOpening.restore', $item->id) }}" hidden>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
                                <button type="button" class="btn btn-primary" id="restore-item"><i
                                        class="fa fa-refresh"></i> Active</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- /table -->
    </div>
    <!-- Restore Modal -->
    <div class="modal fade" id="restore-modal" tabindex="-1" role="dialog" aria-labelledby="restore-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restore-modal-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <h4 class="text-center">Are you sure you want to active this item?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" id="restore-action-confirm" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Restore Modal -->
@endsection
