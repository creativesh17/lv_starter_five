<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="dark-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-dark">
<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template-dark/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 31 Dec 2023 05:13:12 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Welcome</title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap"
        rel="stylesheet" />
    {{-- <link rel="stylesheet" src="{{ asset('contents/backend') }}/assets/"> --}}
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/css/rtl/core-dark.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/css/rtl/theme-default-dark.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet"
        href="{{ asset('contents/backend') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet"
        href="{{ asset('contents/backend') }}/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ asset('contents/backend') }}/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ asset('contents/backend') }}/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/vendor/css/pages/cards-advance.css" />
    <!-- Custom CSS -->
    @stack('push_css')
    <link rel="stylesheet" href="{{ asset('contents/backend') }}/assets/css/style.css" />


    <!-- Helpers -->
    {{-- <script src="{{ asset('contents/backend') }}/assets/vendor/js/helpers.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/js/template-customizer.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/js/config.js"></script> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.s_alert2 = (text = "", icon = "success", title = "successful") => {
            Swal.fire({
                position: "top-end",
                icon,
                title,
                text,
                showConfirmButton: true,
                timer: 2000
            });
        };
        window.s_alert = (title = "success", icon = "success") => {
            Toast.fire({
                icon,
                title,
            });
        };

        window.s_confirm = async (
            title = "Are you sure want to delete?",
            confirmButtonText = "Yes, do it!",

            icon = "warning"
        ) => {
            let result = await Swal.fire({
                title,
                text: "",
                icon,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText,
            });
            return result.isConfirmed ? true : false;
        };

        window.s_approved = async (
            title = "Are you sure want to do it?",
            confirmButtonText = "Yes, do it!",
            icon = "warning"
        ) => {
            let result = await Swal.fire({
                title,
                text: "",
                icon,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText,
            });
            return result.isConfirmed ? true : false;
        };

        window.s_warning = async (title) => {
            let result = Swal.fire({
                icon: "error",
                title: "Error",
                html: `<h5 class='text-danger'>${title}</h5>`,
            });
            return result;
        };

        window.s_error = async (title) => {
            let result = Swal.fire({
                icon: "error",
                title: "Error",
                html: `<h5 class='text-danger'>${title}</h5>`,
            });
            return result;
        };

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

    </script>

    <!-- Vendors JS -->
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/swiper/swiper.js"></script>
    <script src="{{ asset('contents/backend') }}/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <!-- Main JS -->
    {{-- <script src="{{ asset('contents/backend') }}/assets/js/main.js"></script> --}}

    <!-- Custom JS -->
    @stack('push_js')
    <script src="{{ asset('contents/backend') }}/assets/js/custom.js"></script>

    @vite(['resources/my_js/app.js'])
</head>

<body>
    <!-- Layout wrapper -->
    <div id="app">
        <app></app>
    </div>
    <!-- / Layout wrapper -->


</body>

</html>

<!-- beautify ignore:end -->
