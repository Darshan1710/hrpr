@extends('layouts.frontend.master')


@section('title')
    Contact
@endsection

@push('styles')

@endpush

@push('scripts')
<script>
    $("#mobile").keydown(function (e) {
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
    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
        <div id="box_wrapper">
            <section class="page_title cs gradientvertical-background s-py-25">
                <div class="container">
                    <div class="row">

                        <div class="divider-50"></div>

                        <div class="col-md-12 text-center">
                            <h1 class="">Contact Us</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    Contact Us
                                </li>
                            </ol>
                        </div>

                        <div class="divider-50"></div>

                    </div>
                </div>
            </section>


            <section class="lss-overlay s-map-light s-py-50 c-gutter-60 container-px-30">
                <div class="container ">
                    <div class="row">

    

                        <div class="col-lg-6  animate" data-animation="slideDown">

                            <form class="black-bg contact-form c-mb-20 c-gutter-20" method="POST"
                                enctype="multipart/form-data" action="{{ route('contactStore') }}">
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="ds form-group has-placeholder">
                                            <label for="name">Full Name
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" aria-required="true" size="30" name="name" id="name"
                                                value="{{ old('name') }}" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="ds form-group has-placeholder">
                                            <label for="email">Email address
                                                <span class="required">*</span>
                                            </label>
                                            <input type="email" aria-required="true" size="30" name="email" id="email"
                                                value="{{ old('email') }}" class="form-control" placeholder="Email"
                                                required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="ds form-group has-placeholder">
                                            <label for="mobile">Mobile
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" aria-required="true" size="30" name="mobile" id="mobile" minlength="10" maxlength="13"
                                                value="{{ old('mobile') }}" class="form-control" placeholder="Mobile"
                                                required>
                                        </div>
                                    </div>
                                    <input type="text" name="type" id="type" value="Contact" hidden>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="ds form-group has-placeholder">

                                            <label for="comment">Comment</label>
                                            <textarea aria-required="true" rows="6" cols="4" name="comment" id="comment" 
                                                class="form-control" placeholder="Comment" required>{{ old('comment') }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                @if (!$errors->isEmpty())
                                    <div class="row d-flex flex-column align-items-center">
                                        <div class="color-main mt-20">{{ $errors->first() }}</div>
                                        {{-- @foreach ($errors->all() as $error)
                                            <div class="color-main mt-20">{{ $error }}</div>
                                        @endforeach --}}
                                    </div>
                                @endif
                                <div class="row">

                                    <div class="col-sm-12 text-center mt-10">

                                        <div class="form-group">
                                            <button type="submit" id="contact_form_submit" name="contact_submit"
                                                class="btn-color">
                                                Send Now
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>

                        <div class="col-lg-6  animate" data-animation="slideDown">

                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241316.6433229747!2d72.74109780863927!3d19.08252232377542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1601372085899!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        <!--.col-* -->

                        
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
