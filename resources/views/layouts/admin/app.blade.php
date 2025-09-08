<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Home Admin </title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/favicon/favicon-32x32.png') }}" type="image/x-icon">
    <!-- [Google Font] Family -->

    <link rel="stylesheet"
        href="{{ url('https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap') }}"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- summer note text editor --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('/admin_assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('/admin_assets/css/style-preset.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" /> --}}

    {{-- trying to chnage the active link color  --}}
    <style>
        .pc-navbar .pc-item.active {
            background-color: #fc6229 !important;

        }

        .pc-link:after {
            display: block !important;
        }

        .pc-navbar .pc-item.active>.pc-link {
            color: #ffffff !important;
        }


        .pc-navbar .pc-item.active>.pc-link i {
            color: #ffffff !important;
        }

        .pc-header {
            background-color: rgb(255, 141, 99) !important;
        }

        .nav-item .nav-link.active {
            background-color: rgba(252, 97, 41, 0.437) !important;

        }
    </style>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->


<body>
   
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('admin.dashboard') }}" class="b-brand text-dark">
                    <!-- ========   Change your logo from here   ============ -->
                    <img src="{{ asset('assets/favicon/favicon-32x32.png') }}" alt="logo">
                    {{-- <span class="text-lg">Dashboard</span> --}}
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="{{ route('admin.dashboard') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Manage</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.category') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-versions"></i></span>
                            <span class="pc-mtext">Manage Category</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.product') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
                            <span class="pc-mtext">Manage Product</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('manage.filter') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box-multiple"></i></span>
                            <span class="pc-mtext">Manage Filter</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.types') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
                            <span class="pc-mtext">Manage Product Types</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.suitable.for') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-columns"></i></span>
                            <span class="pc-mtext">Manage Suitable For</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.color') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box-multiple"></i></span>
                            <span class="pc-mtext">Manage Color</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.tags') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-tag"></i></span>
                            <span class="pc-mtext">Manage Tags</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item">
                        <a href="{{ route('manage.order') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box-multiple"></i></span>
                            <span class="pc-mtext">Order Listing</span>
                        </a>
                    </li> --}}
                    <li class="pc-item">
                        <a href="{{ route('manage.hsn') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-chart-bar"></i></span>
                            <span class="pc-mtext">Manage HSN</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.tax') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-report-money"></i></span>
                            <span class="pc-mtext">Manage GST Slab Rate</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage.orders') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-list"></i></span>
                            <span class="pc-mtext">Manage Orders</span>
                        </a>
                    </li>




                </ul>

            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        {{-- <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form> --}}
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">

                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img src="/admin_assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex mb-1">
                                    <div class="flex-shrink-0">
                                        <img src="/admin_assets/images/user/avatar-1.jpg" alt="user-image"
                                            class="user-avtar wid-35">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                                        <span>Admin</span>
                                    </div>
                                    <a href="{{ route('admin.logout') }}" class="pc-head-link bg-transparent"><i
                                            class="ti ti-power text-danger"></i></a>
                                </div>
                            </div>
                            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="drp-t1" data-bs-toggle="tab"
                                        data-bs-target="#drp-tab-1" type="button" role="tab"
                                        aria-controls="drp-tab-1" aria-selected="true"><i class="ti ti-user"></i>
                                        Profile</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel"
                                    aria-labelledby="drp-t1" tabindex="0">
                                    <a href="{{ route('admin.change.password') }}" class="dropdown-item">
                                        <i class="ti ti-edit-circle"></i>
                                        <span>Change Password</span>
                                    </a>

                                    <a href="{{ route('admin.logout') }}" class="dropdown-item">
                                        <i class="ti ti-power"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->


    <!-- [Page Specific JS] start -->
    <script src="{{ asset('/admin_assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/admin_assets/js/pages/dashboard-default.js') }}"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('/admin_assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/admin_assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('/admin_assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admin_assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('/admin_assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('/admin_assets/js/plugins/feather.min.js') }}"></script>



    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>




    <!-- [Body] end -->

    @yield('main-container')
    
    @stack('scripts')

    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">  crafted with &#9829; by team @ BantTech with Manish Pandey </a></p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        {{-- <li class="list-inline-item"><a href="#">Home</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>
<!-- [Body] end -->

</html>
