@extends('layouts.backend.master')

@section('title')
    Enquiry - Edit
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
                            <h2 class="m-0">View Enquiry</h2>
                        </div>
                        <div class="card-body">
                            {{-- {{ csrf_field() }} --}}
                            {{-- {{ method_field('patch') }} --}}
                            <!--  name -->
                            <div class="form-group">
                                <label class="col-form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $enquiry->name) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / name -->
                            <!--  mobile -->
                            <div class="form-group">
                                <label class="col-form-label" for="mobile">Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                    value="{{ old('mobile', $enquiry->mobile) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / mobile -->
                            <!--  email -->
                            <div class="form-group">
                                <label class="col-form-label" for="mobile">Email</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    value="{{ old('email', $enquiry->email) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / email -->
                            <!-- comment -->
                            <div class="form-group3">
                                <label class="col-form-label" for="comment">Comment</label>
                                <textarea name="comment" class="form-control" id="comment"
                                    readonly="readonly">{{ $enquiry->comment }}</textarea>
                            </div>
                            <!-- /comment -->
                            <!--  type -->
                            <div class="form-group">
                                <label class="col-form-label" for="type">Type</label>
                                <input type="text" name="type" class="form-control" id="type"
                                    value="{{ old('type', $enquiry->type) }}" readonly="readonly" required autofocus>
                            </div>
                            <!-- / type -->
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
                                    <a href="{{ route('admin.enquiry.index') }}" class="btn btn-block btn-danger">close</a>
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
