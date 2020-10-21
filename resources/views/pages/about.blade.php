@extends('layouts.frontend.master')


@section('title')
    About
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
                            <h1 class="">About</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    About
                                </li>
                            </ol>
                        </div>

                        <div class="divider-50"></div>

                    </div>
                </div>
            </section>

            <section class="ls about about-padge s-pt-30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 animate" data-animation="slideInLeft">
                            <div class="heading-about">
                            <h2>
                                HR
                            </h2>
                            <h4>
                                Welcome to
                            </h4>
                            <h3>
                                Leisha!
                            </h3>
                            <p>
                                Specialized in Fulfilling Manpower requirements & providing HR Services. We are known for maintaining good relations
                                with clients based on trust and understanding. Headquartered in Mumbai.
                            </p>
                            </div>
                            <div class="icons-list">
                                <ul class="list-bordered">
                                    <li class=" media media-body">
                                        <i class="teaser-icon fa fa-rocket"></i>
                                        <h4 class="title">
                                            <span>638</span> Companies We Helped
                                        </h4>
                                    </li>
                                    <li class="media media-body">
                                        <i class="teaser-icon fa fa-briefcase"></i>
                                        <h4 class="title">
                                            <span>12</span> Corporate Programs
                                        </h4>
                                    </li>
                                    <li class="media media-body">
                                        <i class="teaser-icon fa fa-graduation-cap"></i>
                                        <h4 class="title">
                                            <span>28</span> Trainings Courses
                                        </h4>
                                    </li>
                                    <li class="border-bottom-0 media media-body">
                                        <i class="teaser-icon fa fa-user"></i>
                                        <h4 class="title">
                                            <span>125</span> Strategic Partners
                                        </h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 animate" data-animation="slideInRight">
                            <img src="{{ asset('assets/images/person01.jpg')}}" alt="person01.jpg">
                        </div>
                    </div>
                </div>
            </section>

            <section class="icon-boxed teaser-box ls s-py-lg-130 c-my-lg-10 s-parallax">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 animate" data-animation="pullUp">
                            <div class="icon-box text-justify hero-bg box-shadow">
                                <div class="teaser-icon icon-styled bg-maincolor3">
                                    <i class="fa fa-unlock-alt"></i>
                                </div>
                                <h3>
                                    <a href="#">Our Vision</a>
                                </h3>
                                <p>
                                    To be recognized and respected as a leading employment and recruitment services company in India without compromising on
                                    quality services to our clients. Creating higher HR and business performance through people, productivity and
                                    service. To be the most preferred consultancy services entity with cost effective services. To be Corporate Leader in
                                    the Recruitment Industry.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 animate" data-animation="pullUp">
                            <div class="icon-box text-justify hero-bg box-shadow">
                                <div class="teaser-icon icon-styled bg-maincolor3">
                                    <i class="fa fa-cloud"></i>
                                </div>
                                <h3>
                                    <a href="#">Our Mission</a>
                                </h3>
                                <p>
                                    Company mission is to Attract, Hire and Retain top talent for our clients. We believe that quality is not an end
                                    result, it has to be caused. To become one the most dependable firm in the field of Recruitment & Placement. To set the
                                    trends & benchmarks for the industry & provide complete Placement Solutions under one umbrella.
                                </p>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </section>

           <section class="ds section_gradient gradient-background py-50">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center animate" data-animation="pullUp">
                    <div class="info-block">
                        <p>
                            Call Us 24/7
                        </p>
                        <h3>
                            022 49684175 / 8169686873
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 text-center animate" data-animation="pullUp">
                    <div class="info-block">
                        <p>
                            Email Address
                        </p>
                        <h3>
                            example@example.com
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 text-center animate" data-animation="pullUp">
                    <div class="info-block">
                        <p>
                            Open Hours
                        </p>
                        <h3>
                            Daily 9:00-20:00
                        </h3>
                    </div>
                </div>
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
