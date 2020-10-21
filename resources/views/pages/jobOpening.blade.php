@extends('layouts.frontend.master')


@section('title')
    Job Opening
@endsection

@push('styles')

@endpush

@push('scripts')

    <script>
        $('#exampleModal').on('show.bs.modal', function(e) {
            var job = $(e.relatedTarget);
            var jobId = job.data('job-id');
            $('#job-id').val(jobId);
            // console.log(jobId);
        })

    </script>
    <script>
        $("#phone").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>

@endpush

@section('page-content')
    <div id="canvas">
        <div id="box_wrapper">
            @include('layouts.backend.messages')
            <section class="page_title cs gradientvertical-background s-py-25">
                <div class="container">
                    <div class="row">

                        <div class="divider-50"></div>

                        <div class="col-md-12 text-center">
                            <h1 class="">Job Opening</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    Job Opening
                                </li>
                            </ol>
                        </div>

                        <div class="divider-50"></div>

                    </div>
                </div>
            </section>


            <section class="ls s-py-50 c-gutter-60">
                <div class="container">
                    <div class="row">

                        <div class="d-none d-lg-block divider-70"></div>

                        @if ($jobOpening->isNotEmpty())
                            @foreach ($jobOpening as $item)
                                <div class="product col-12 col-md-12 col-lg-6 col-xl-4" style="margin-bottom: 45px;">
                                    <div class="box product1">
                                        <div class="media-shop">
                                            {{-- <img src="images/shop/product-2.png" alt="">
                                            --}}
                                        </div>
                                        <div class="shop-item">
                                            <div>
                                                <h2 style="text-align: center;">
                                                    {{ $item->job_title }}
                                                </h2>
                                            </div>

                                            <div class="skillset" style="margin-top:10px;">
                                                <span>Skillset</span> :- {{ $item->skillset }}
                                            </div>
                                            <div class="location">
                                                <span>Location</span> :- {{ $item->location }}
                                            </div>
                                            <div class="experience">
                                                <span>Experience Required</span> :-
                                                {{ $item->required_experience }}
                                            </div>
                                            <p>
                                                {{ $item->description }}
                                            </p>

                                            <div style="text-align: center;"><a class="button" data-job-id="{{ $item->id }}"
                                                    data-toggle="modal" data-target="#exampleModal">Apply</a></div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- Modal HTML embedded directly into document -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:130%;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Job Application</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <!-- <form class="ds contact-form c-mb-20" method="POST" enctype="multipart/form-data"
                                            {{-- action="{{ route('applicationStore') }}">
                                            {{ csrf_field() }} --}}

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" name="job-id" id="job-id" hidden>
                                                    <div class="col-c-mb-60 form-group has-placeholder">
                                                        <label for="name">Full Name
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" aria-required="true" size="200" value=""
                                                            name="name" id="name" class="form-control"
                                                            placeholder="Full Name">
                                                    </div>
                                                    <div class="col-c-mb-60 form-group has-placeholder">
                                                        <label for="phone">Phone number
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" aria-required="true" size="200" value=""
                                                            name="phone" id="phone" class="form-control"
                                                            placeholder="Phone number">
                                                    </div>
                                                    <div class="col-c-mb-60 form-group has-placeholder">
                                                        <label for="email">Email address
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="email" aria-required="true" size="200" value=""
                                                            name="email" id="email" class="form-control"
                                                            placeholder="Email address">
                                                    </div>
                                                    <div class="col-c-mb-60 form-group has-placeholder">
                                                        <label for="job-sector">Job sector
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" aria-required="true" size="200" value=""
                                                            name="job-sector" id="job-sector" class="form-control"
                                                            placeholder="Job sector">
                                                    </div>
                                                    <div class="col-c-mb-60 form-group">
                                                        <input type="file" class="custom-file-input button" id="cv"
                                                            name="cv">
                                                        <label class="custom-file-label" for="cv">Attach CV</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group has-placeholder">
                                                        <label for="comment">Comment</label>
                                                        <textarea aria-required="true" rows="6" cols="40" name="comment"
                                                            id="comment" class="form-control"
                                                            placeholder="comment"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group text-center">
                                                    <button type="submit" id="contact_form_submit" name="contact_submit"
                                                        class="button">Submit CV</button>
                                                </div>
                                            </div>
                                        </form> -->
                                <form class="ds contact-form c-mb-15 c-gutter-15" method="POST" enctype="multipart/form-data"
                                action="{{ route('applicationStore') }}">
                                    {{ csrf_field() }}
                                 <input type="text" name="job-id" id="job-id" hidden>

                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group has-placeholder">
                                                <label for="name">Full Name
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" size="30" value="" name="name" id="name" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-placeholder">
                                                <label for="phone">Phone
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" size="30" value="" name="phone" id="phone" class="form-control" placeholder="Phone">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group has-placeholder">
                                                <label for="email">Email address
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="email"  size="30" value="" name="email" id="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-placeholder">
                                                <label for="job-sector">Job Sector
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" size="30" value="" name="job-sector" id="job-sector" class="form-control" placeholder="Job Sector">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-bottom:15px;">

                                        <div class="col-sm-12">

                                            <div class="form-group has-placeholder">
                                                <label for="cv">CV</label>
                                                
                                                <input type="file"  value="" name="cv" id="cv" class="form-control" placeholder="CV">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="form-group has-placeholder">
                                                <label for="comment">Message</label>
                                                <textarea aria-required="true" rows="2" cols="45" name="comment" id="comment" class="contact form-control" placeholder="Message"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="form-group has-placeholder text-center">
                                                <button type="submit" id="contact_form_submit" name="contact_submit" class="button">Submit
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Link to open the modal -->
                        {{-- <p><a href="#ex1" rel="modal:open">Open Modal</a></p>
                        --}}


                        <button class="d-none d-lg-block divider-70"></button>
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
