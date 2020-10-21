@extends('layouts.frontend.master')


@section('title')
    Gallery
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush

@section('page-content')
    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
        <div id="box_wrapper">

            {{-- <h2>Work in progress</h2> --}}

            <section class="page_title cs gradientvertical-background s-py-25">
                <div class="container">
                    <div class="row">

                        <div class="divider-50"></div>

                        <div class="col-md-12 text-center">
                            <h1 class="">Gallery</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    Gallery
                                </li>
                            </ol>
                        </div>

                        <div class="divider-50"></div>

                    </div>
                </div>
            </section>


            <section class="s-pt-15 s-pb-50 pb-10">
                <div class="container">
                    <div class="row">

                        <div class="d-none d-lg-block divider-100"></div>

                        <div class="col-lg-12">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-xl-8">
                                    <div class="filters gallery-filters text-lg-right">
                                        <a href="#" data-filter="*" class="active selected">All</a>
                                        @foreach ($album as $item)
                                            <a href="#" data-filter=".{{  $item->album }}" class="">{{  $item->album }}</a>
                                        @endforeach
                                       
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="row isotope-wrapper masonry-layout c-mb-30 gallery-image-regular"
                                data-filters=".gallery-filters">

                                @if ($gallery->isNotEmpty())
                                @foreach ($gallery as $item)
                                    <div class="col-xl-4 col-sm-6 innovations corporate">
                   
                                    <div class="vertical-item item-gallery content-absolute text-center ds">
                                       
                                        <div class="item-media">
                                            <img src="{{  $item->file_path }}" alt="">                                           
                                             
                                        </div>
                                        
                                    </div>
                                </div>
                                    @endforeach
                                   @endif

                            </div> --}}
                            <!-- .isotope-wrapper-->
                            <div class="row isotope-wrapper masonry-layout c-mb-30 gallery-image-regular" data-filters=".gallery-filters">
                            @if ($gallery->isNotEmpty())
                            @foreach ($gallery as $item)
                            
                                <div class="col-xl-4 col-sm-6 {{ $item->album }}">
                            
                                {{-- <div class="col-xl-4 col-sm-6 innovations corporate"> --}}
                                    <div class="vertical-item item-gallery content-absolute text-center ds">
                                        <div class="item-media">
                                            <img src="{{  $item->file_path }}" alt="" style="height: 250px;">
                                            <div class="media-links">
                                                <div class="links-wrap">
                                                    <a class="link-zoom photoswipe-link" title="" href="{{  $item->file_path }}"></a>
                                                    {{-- <a class="link-anchor" title="" href="gallery-single.html"></a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                               
                            </div>

                            {{-- <div class="row gallery">
                                <div class="col-sm-12 text-center">
                                    <a href="#" class="btn btn-outline-darkgrey">Load More</a>
                                </div>
                            </div> --}}

                        </div>

                        <div class="d-none d-lg-block divider-100"></div>
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
