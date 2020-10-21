@extends('layouts.backend.master')

@section('title')
    Job Application - View
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
                <form class="form-horizontal">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">View Job Application</h2>
                        </div>
                        <div class="card-body">
                            {{-- {{ csrf_field() }} --}}
                            {{-- {{ method_field('patch') }} --}}
                            <!--  job id -->
                            <div class="form-group">
                                <label class="col-form-label" for="job-id">Category</label>
                                <input type="text" name="job-id" class="form-control" id="job-id"
                                    value="{{ old('name', $jobApplication->category) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / job id -->
                            <!--  name -->
                            <div class="form-group">
                                <label class="col-form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $jobApplication->name) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / name -->
                            <!--  mobile -->
                            <div class="form-group">
                                <label class="col-form-label" for="phone">Mobile</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    value="{{ old('mobile', $jobApplication->phone) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / mobile -->
                            <!--  email -->
                            <div class="form-group">
                                <label class="col-form-label" for="mobile">Email</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    value="{{ old('email', $jobApplication->email) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / email -->
                            <!--  job sector -->
                            <div class="form-group">
                                <label class="col-form-label" for="job-sector">Email</label>
                                <input type="text" name="job-sector" class="form-control" id="job-sector"
                                    value="{{ old('email', $jobApplication->job_sector) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / job sector -->
                            <!-- comment -->
                            <div class="form-group3">
                                <label class="col-form-label" for="comment">Comment</label>
                                <textarea name="comment" class="form-control" id="comment"
                                    readonly="readonly">{{ $jobApplication->comment }}</textarea>
                            </div>
                            <!-- /comment -->
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                {{-- <div class="col">
                                    <!-- submit -->
                                    <button type="submit" class="btn btn-block btn-success">Update</button>
                                    <!-- /submit -->
                                </div> --}}
                                <div class="col">
                                    <!-- cancel -->
                                    <a href="{{ route('admin.application.index') }}" class="btn btn-block btn-danger">close</a>
                                    <!-- /cancel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
