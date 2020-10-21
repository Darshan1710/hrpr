@extends('layouts.backend.master')

@section('title')
    Album - Create
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
                    action="{{ route('admin.album.store') }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Create New Album</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="album">Album</label>
                                <input type="text" name="album" class="form-control" id="album"
                                    value="{{ old('album') }}" required autofocus>
                            </div>
                            <!-- /title -->

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
                                    <a href="{{ route('admin.album.index') }}"
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
