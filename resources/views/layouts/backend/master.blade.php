<!DOCTYPE html>
<html>

<head>
    @include('layouts.backend.head')
</head>

<body>
    @if (request()->is('login'))
        @include('layouts.backend.navigation.login-navigation')
    @elseif(Auth::check())
        @if (Auth::user()->role == 'admin')
            @include('layouts.backend.navigation.admin-navigation')
        @endif
    @endif

    <div class="page-content">
        @yield('page-content')
    </div>

    @include('layouts.backend.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/admin/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/bootstrap.min.js') }}"></script>
    <script>
        // submenu dropdown script 
        $(document).ready(function() {
            $('.alert').delay(1000).fadeOut(2000);

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
        })

    </script>
    <!-- Custom scripts -->
    @stack('scripts')
</body>

</html>
