@extends('layouts.backend.master')

@section('title')
    Services - Edit
@endsection

@push('styles')
    @include('admin.injector.admin-attriutes-injector')
@endpush

@push('scripts')

@endpush

@section('page-content')
    <div class="main-container container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                @include('layouts.backend.messages')
                <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.services.update', $services->id) }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Edit Testimonials</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <!-- title -->
                            <div class="form-group mb-0">
                                <label class="col-form-label" for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('name', $services->title) }}" required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- description -->
                            <div class="form-group3">
                                <label class="col-form-label" for="description">Description</label>
                                <textarea name="description" class="form-control"
                                    id="description">{{ $services->description }}</textarea>
                            </div>
                            <!-- /description -->
                            <!-- image -->
                            <div class="form-group mb-0">
                                <label class="col-form-label" for="services-image">Image</label>
                                <input type="file" name="services-image" class="form-control" id="services-image">
                            </div>
                            <!-- /image -->
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <!-- submit -->
                                    <button type="submit" class="btn btn-block btn-success">Update</button>
                                    <!-- /submit -->
                                </div>
                                <div class="col">
                                    <!-- cancel -->
                                    <a href="{{ route('admin.services.index') }}"
                                        class="btn btn-block btn-danger">Cancel</a>
                                    <!-- /cancel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Assign Modal -->
    <div class="modal fade" id="assign-modal" tabindex="-1" role="dialog" aria-labelledby="assign-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assign-modal-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="assign-body-content">
                    <h3 class="text-center">Loading...</h3>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Assign Modal -->
    <!-- Attachment Modal -->
    <div class="modal fade" id="attachment-modal" tabindex="-1" role="dialog" aria-labelledby="attachment-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachment-modal-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attachment-body-content">
                    <h3 class="text-center">Loading...</h3>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Attachment Modal -->
@endsection
