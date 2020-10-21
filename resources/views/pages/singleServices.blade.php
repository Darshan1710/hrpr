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
							<h1 class="">Single Service</h1>
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="#">Home</a>
								</li>

								<li class="breadcrumb-item active">
									Single Service
								</li>
							</ol>
						</div>

						<div class="divider-50"></div>

					</div>
				</div>
			</section>


			<section class="ls s-py-75 s-py-lg-130">
				<div class="container">
					<div class="d-none d-lg-block divider-30"></div>
					<div class="row">
						<div class="col-lg-6 animate" data-animation="fadeInLeft">
							<img src="{{ asset('assets/images/service_images/' . $singleServices->image_path) }}" alt="" style="width: inherit;">
						</div>
						<div class="single-service divider-30 col-lg-6 text-left animate" data-animation="fadeInRight">
							<div class="content mx-30">
								<h4 class="single-service">{{ $singleServices->title }}</h4>
								<p>
									{{ $singleServices->description }}
								</p>
								{{-- <ul class="list-styled">
									<li>
										Meatball biltong pork belly
									</li>
									<li>
										Corned beef pig turkey pastrami
									</li>
									<li>
										Chuck doner ham salami pork
									</li>
									<li>
										Frankfurter tongue ball tip cupim
									</li>
								</ul> --}}
							</div>
						</div>
					</div>
					{{-- <div class="row">
						<div class="col-sm-12">
<<<<<<< HEAD
							<p class="divider-sm-50 animate" data-animation="fadeInUp">
=======
							<p class="divider-sm-50 animate text-justify" data-animation="fadeInUp">
>>>>>>> master
								Beef frankfurter ham hock, t-bone leberkas salami boudin tail porchetta kevin pork chuck picanha ground round. Hamburger salami capicola picanha, shoulder short loin ham hock meatball sirloin pancetta fatback. Chicken ground round jowl pork tongue biltong
								prosciutto shank burgdoggen pork chop kielbasa doner flank short loin shoulder. Turkey pastrami kevin, corned beef kielbasa t-bone strip steak ribeye landjaeger. Prosciutto fatback boudin pastrami, sirloin chicken t-bone kielbasa
							</p>
						</div>
					</div> --}}
					<div class="d-none d-lg-block divider-20"></div>
                </div>
			</section>

		</div>
		<!-- eof #box_wrapper -->
	</div>
	<!-- eof #canvas -->
    @include('layouts.frontend.enquiry-form-injector')
    @yield('enquiry-form-html')
@endsection
