@extends('layouts.backend.master')

@section('title')
    Job Opening - Create
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
                    action="{{ route('admin.jobOpening.store') }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Create New Job</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <!-- job title -->
                            <div class="form-group">
                                <label class="col-form-label" for="job-title">Job Title</label>
                                <input type="text" name="job-title" class="form-control" id="job-title"
                                    value="{{ old('job-title') }}" required autofocus>
                            </div>
                            <!-- /job title -->
                            <!--category-->
                            <div class="form-group mb-0">
                                <label class="col-form-label" for="category">Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="category" id="category" required="required">
                                        <option value="">Select Category</option>
                                        @foreach ($categoryList as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/category-->
                            <!-- job description -->
                            <div class="form-group3">
                                <label class="col-form-label" for="description">Description</label>
                                <textarea name="description" class="form-control" id="description"></textarea>
                            </div>
                            <!-- /job description -->
                            <!-- skillset -->
                            <div class="form-group3">
                                <label class="col-form-label" for="skillset">Skillset</label>
                                <textarea name="skillset" class="form-control" id="skillset"></textarea>
                            </div>
                            <!-- /skillset -->
                            <!-- location -->
                            <div class="form-group3">
                                <label class="col-form-label" for="location">Location</label>
                                <textarea name="location" class="form-control" id="location"></textarea>
                            </div>
                            <!-- /location -->
                            <!-- required experience -->
                            <div class="form-group3">
                                <label class="col-form-label" for="required-experience">Required Experience</label>
                                <textarea name="required-experience" class="form-control"
                                    id="required-experience"></textarea>
                            </div>
                            <!-- /required experience -->

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
                                    <a href="{{ route('admin.jobOpening.index') }}"
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
