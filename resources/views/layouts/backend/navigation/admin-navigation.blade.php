
<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu a::after {
        transform: rotate(-90deg);
        position: absolute;
        right: 6px;
        top: .8em;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .1rem;
        margin-right: .1rem;
    }
</style>
{{-- 
<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
                }
                var $subMenu = $(this).next('.dropdown-menu');
                $subMenu.toggleClass('show');


                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass('show');
                });
                return false;
            });
</script> --}}
<!-- navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a href="{{ route('admin.category.index') }}" class="navbar-brand">Consultancy - {{ Auth::user()->name }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- Category  -->
            <li class="nav-item dropdown {{ request()->is('admin/category*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Job Category
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.category.index') }}">Show All</a>
                    <a class="dropdown-item" href="{{ route('admin.category.create') }}">Create New</a>
                    <a class="dropdown-item" href="{{ route('admin.category.deleted') }}">Inactive Category</a>
                </div>
            </li>
            <!-- /Category -->

            <!-- Client -->
            <li class="nav-item dropdown {{ request()->is('admin/client*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Client
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.client.index') }}">Show All</a>
                    <a class="dropdown-item" href="{{ route('admin.client.create') }}">Create New</a>
                    <a class="dropdown-item" href="{{ route('admin.client.deleted') }}">Inactive Client</a>

                </div>
            </li>
            <!-- /Client -->

            <!-- Enquiry -->
            <li class="nav-item dropdown {{ request()->is('admin/enquiry*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Enquiry
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.enquiry.index') }}">Show All</a>
                    {{-- <a class="dropdown-item"
                        href="{{ route('admin.enquiry.index') }}">Create New</a> --}}
                    <a class="dropdown-item" href="{{ route('admin.enquiry.deleted') }}">Completed Enquiry</a>

                </div>
            </li>
            <!-- /Enquiry -->

            <!-- Job Application -->
            <li class="nav-item dropdown {{ request()->is('admin/application*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Job Application
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.application.index') }}">Show All</a>
                    {{-- <a class="dropdown-item"
                        href="{{ route('admin.application.create') }}">Create New</a> --}}
                    <a class="dropdown-item" href="{{ route('admin.application.deleted') }}">Completed Application</a>
                   

                </div>
            </li>
            <!-- /Job Application -->

            <!-- Job Opening -->
            <li class="nav-item dropdown {{ request()->is('admin/jobOpening*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Job Opening
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.jobOpening.index') }}">Show All</a>
                    <a class="dropdown-item" href="{{ route('admin.jobOpening.create') }}">Create New</a>
                    <a class="dropdown-item" href="{{ route('admin.jobOpening.deleted') }}">Inactive Jobs</a>

                </div>
            </li>
            <!-- /Job Opening -->

            <!-- Services -->
            <li class="nav-item dropdown {{ request()->is('admin/services*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Services
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.services.index') }}">Show All</a>
                    <a class="dropdown-item" href="{{ route('admin.services.create') }}">Create New</a>
                    <a class="dropdown-item" href="{{ route('admin.services.deleted') }}">Inactive Services</a>
                </div>
            </li>
            <!-- /Services -->

            <!-- Slider -->
            <li class="nav-item dropdown {{ request()->is('admin/slider*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Slider
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.slider.index') }}">Show All</a>
                    <a class="dropdown-item" href="{{ route('admin.slider.create') }}">Create New</a>
                    <a class="dropdown-item" href="{{ route('admin.slider.deleted') }}">Inactive Slider</a>

                </div>
            </li>
            <!-- /Slider -->

            <!-- Gallery -->

            <li class="nav-item dropdown {{ request()->is('admin/gallery*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Gallery
                </a>

                <ul class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Album</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.album.index') }}">Show All</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.album.create') }}">Add New</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.album.deleted') }}">Inactive Album</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Gallery</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.gallery.index') }}">Show All</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.gallery.create') }}">Create New</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.gallery.deleted') }}">Inactive Gallery</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- /gallery -->

            <!-- Testimonials -->
            <li class="nav-item dropdown {{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Testimonials
                </a>
                <div class="dropdown-menu mt-auto" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.testimonials.index') }}">Show All</a>
                    <a class="dropdown-item" href="{{ route('admin.testimonials.create') }}">Create New</a>
                    <a class="dropdown-item" href="{{ route('admin.testimonials.deleted') }}">Inactive Testimonials</a>

                </div>
            </li>
            <!-- /Testimonials -->

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-sign-out-alt "></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>
<!-- /navigation -->
