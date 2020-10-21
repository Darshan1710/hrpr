@extends('layouts.frontend.master')


@section('title')
    Services
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush

@section('page-content')
    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
        <div id="box_wrapper">

            <section class="page_title cs gradientvertical-background s-py-25">
                <div class="container">
                    <div class="row">

                        <div class="divider-50"></div>

                        <div class="col-md-12 text-center">
                            <h1 class="">Services</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    Services
                                </li>
                            </ol>
                        </div>

                        <div class="divider-50"></div>

                    </div>
                </div>
            </section>


            <section class="ls s-pt-100 s-py-75 c-gutter-50 c-mb-50 services1">
                <div class="container px-30">
                    <div class="row">

                        <div class="d-none d-lg-block divider-80"></div>

                        @if ($services->isNotEmpty())
                            @foreach ($services as $item)
                                <div class="col-md-6 col-lg-4">

                                    <div class="vertical-item text-center item-content">
                                        <div class="item-media">
                                            <img src="{{ asset('assets/images/service_images/' . $item->image_path) }}"
                                                alt="" style="height:240px; width: 345px;">
                                            <div class="media-links">
                                                <a class="link" title="" href="service-single.html"></a>
                                            </div>
                                        </div>
                                        <div class="item-content box services">
                                            <h4>
                                                <a href="service-single.html">{{ $item->title }}</a>
                                            </h4>

                                            <p class="text-justify">
                                                {{ \Illuminate\Support\Str::limit($item->description, 120, $end=' .....') }}
                                            </p>

                                            <a href="{{ route('singleServices', $item->id) }}" style="color:black; padding:10px; text-decoration:none; background:#a6a6d0; border: #7f6767 solid 1px; border-radius: 45px;">Read More...</a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- .col-* -->
                        <div class="d-none d-lg-block divider-30"></div>
                    </div>
                </div>
            </section>

        </div>
        <!-- eof #box_wrapper -->
    </div>
    <!-- eof #canvas -->
    @include('layouts.frontend.enquiry-form-injector')
    @yield('enquiry-form-html')
@endsection
