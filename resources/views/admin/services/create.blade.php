@extends('layouts.backend.master')

@section('title')
    Services - Create
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
                    action="{{ route('admin.services.store') }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Create Services</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}"
                                    required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- description -->
                            <div class="form-group3">
                                <label class="col-form-label" for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" required
                                    autofocus></textarea>
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
                                    <button type="submit" class="btn btn-block btn-success">Create</button>
                                    <!-- /submit -->
                                </div>
                                <div class="col">
                                    <!-- cancle -->
                                    <a href="{{ route('admin.services.index') }}"
                                        class="btn btn-block btn-danger">Cancel</a>
                                    <!-- /cancle -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
