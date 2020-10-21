@extends('layouts.backend.master')

@section('title')
    Testimonials - Edit
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
                <form class="form-horizontal" method="POST"
                    action="{{ route('admin.testimonials.update', $testimonials->id) }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Edit Testimonials</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <!-- name -->
                            <div class="form-group mb-0">
                                <label class="col-form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $testimonials->name) }}" required autofocus>
                            </div>
                            <!-- /name -->
                            <!-- testimonials -->
                            <div class="form-group3">
                                <label class="col-form-label" for="testimonials">Testimonials</label>
                                <textarea name="testimonials" class="form-control"
                                    id="testimonials">{{ $testimonials->testimonials }}</textarea>
                            </div>
                            <!-- /testimonials -->
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
                                    <a href="{{ route('admin.testimonials.index') }}"
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
