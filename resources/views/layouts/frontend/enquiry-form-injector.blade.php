<!-- enquiry form start -->
@section('enquiry-form-html')
    <div class="floating-form" id="contact_form">
                            <div class="close-button"></div>

        <div class="contact-opener" id="contact-opener">Enquiry</div>
        <div id="contact_results"></div>

        <div id="contact_body">

            <form class="black-bg contact-form c-mb-20 c-gutter-20" method="POST" enctype="multipart/form-data"
                action="{{ route('enquiryStore') }}">
                {{ csrf_field() }}

                <div class="row">

                    <div class="col-sm-6">
                        <div class="ds form-group has-placeholder">
                            <label for="enquiry-name">Full Name
                                <span class="required">*</span>
                            </label>
                            <input type="text" aria-required="true" size="30" name="enquiry-name" id="enquiry-name"
                                class="form-control" value="{{ old('enquiry-name') }}" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="ds form-group has-placeholder">
                            <label for="enquiry-email">Email address
                                <span class="required">*</span>
                            </label>
                            <input type="enquiry-email" aria-required="true" size="30" name="enquiry-email"
                                id="enquiry-email" class="form-control" value="{{ old('enquiry-email') }}"
                                placeholder="Email" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <div class="ds form-group has-placeholder">
                            <label for="enquiry-mobile">Mobile
                                <span class="required">*</span>
                            </label>
                            
                            <input type="text" aria-required="true" size="30" name="enquiry-mobile" id="enquiry-mobile" minlength="10" maxlength="13"
                                class="form-control" value="{{ old('enquiry-mobile') }}" placeholder="Mobile" required>
                        </div>
                    </div>
                    <input type="text" name="enquiry-type" id="enquiry-type" value="Enquiry" hidden>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ds form-group has-placeholder">
                            <label for="enquiry-comment">Comment</label>
                            <textarea aria-required="true" rows="6" cols="4" name="enquiry-comment" id="enquiry-comment"
                                class="form-control" placeholder="Comment" required>{{ old('enquiry-comment') }}</textarea>
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
                            <button type="submit" id="contact_form_submit" name="contact_submit" class="btn-color">
                                Send Now
                            </button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection

<!-- enquiry form end -->

@push('styles')
    <style>
        /* floating box style */
        .floating-form {
            z-index: 9999;
            max-width: 430px;
            padding: 30px 30px 10px;
            font: 13px Arial, Helvetica, sans-serif;
            background: #F9F9F9;
            border: 1px solid #ddd;
            right: 10px;
            position: fixed;
            box-shadow: -2px 0 8px rgba(43, 33, 33, .06);
            -moz-box-shadow: -2px 0 8px rgba(43, 33, 33, .06);
            -webkit-box-shadow: -2px 0 8px rgba(43, 33, 33, .06);
        }

        .contact-opener {
            position: absolute;
            left: -56px;
            transform: rotate(-90deg);
            top: 100px;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, .43);
            border-radius: 5px 5px 0 0;
            -webkit-border-radius: 5px 5px 0 0;
            -moz-border-radius: 5px 5px 0 0;

            -moz-box-shadow: inset 0 1px 0 0 #3985B1;
            -webkit-box-shadow: inset 0 1px 0 0 #3985B1;
            box-shadow: inset 0 1px 0 0 #3985B1;
            background-color: #216288;
            border: 1px solid #17445E;
            display: inline-block;
            cursor: pointer;
            color: #FFF;
            padding: 8px 18px;
            text-decoration: none;
            font: 12px Arial, Helvetica, sans-serif;
        }
        .close-button {
  position: absolute;
  right: 32px;
  top: 32px;
  width: 32px;
  height: 32px;
  opacity: 0.3;
}
.close-button:hover {
  opacity: 1;
}
.close-button:before, .close-button:after {
  position: absolute;
  left: 15px;
  content: ' ';
  height: 33px;
  width: 2px;
  background-color: #333;
}
.close-button:before {
  transform: rotate(45deg);
}
.close-button:after {
  transform: rotate(-45deg);
}

    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            var _scroll = true,
                _timer = false,
                _floatbox = $("#contact_form"),
                _floatbox_opener = $(".contact-opener");
            _floatbox.css({
                "right": "-430px",
                "top": "0px"
            }); //initial contact form position

            //Contact form Opener button
            _floatbox_opener.click(function() {
                if (_floatbox.hasClass('visiable')) {
                    _floatbox.animate({
                        "right": "-430px"
                    }, {
                        duration: 300
                    }).removeClass('visiable');
                } else {
                    _floatbox.animate({
                        "right": "0px"
                    }, {
                        duration: 300
                    }).addClass('visiable');
                }
            });
        });

    </script>
    <script>
         $(".close-button").click(function(){
         $( "#contact-opener" ).click();
            });
    </script>
    <script>
        $("#enquiry-mobile").keydown(function (e) {
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
