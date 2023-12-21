<!doctype html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark">

    <head>

        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="vexel – Bootstrap 5  Admin & Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords"
            content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dist/assets/images/brand/favicon.ico') }}">

        <!-- Main Theme Js -->
        <script src="{{ asset('dist/assets/js/main.js') }}"></script>

        <!-- Choices JS -->
        <script src="{{ asset('dist/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

        <!-- TITLE -->
        <title>{{ env('APP_NAME') }}</title>

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{ asset('dist/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- STYLE CSS -->
        <link href="{{ asset('dist/assets/css/style.css') }}" rel="stylesheet">

        <!-- Simplebar Css -->
        <link href="{{ asset('dist/assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

        <!--- FONT-ICONS CSS -->
        <link href="{{ asset('dist/assets/css/icons.css') }}" rel="stylesheet">

        <!-- Color Picker Css -->
        <link rel="stylesheet" href="{{ asset('dist/assets/libs/flatpickr/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

        <!-- Choices Css -->
        <link rel="stylesheet" href="{{ asset('dist/assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" referrerpolicy="no-referrer" />
        <!-- Bootstrap datepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/datepicker/bootstrap-datepicker.min.css') }}">
    </head>

    <body class="app sidebar-mini">


        @include('layouts.switcher');


        <!-- GLOBAL-LOADER -->
        <div id="loader">
            <img src="{{ asset('dist/assets/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOBAL-LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="page-main">

            <!-- app-header -->
            <header class="app-header header sticky">

                <!-- Start::main-header-container -->
                <div class="main-header-container container-fluid">

                    <!-- Start::header-content-left -->
                    <div class="header-content-left align-items-center">

                        <div class="header-element">
                            <div class="horizontal-logo">
                                <a href="index.html" class="header-logo">
                                    <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="desktop-logo">
                                    <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="toggle-logo">
                                    <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="desktop-dark">
                                    <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="toggle-dark">
                                </a>
                            </div>
                        </div>
                        <!-- Start::header-element -->
                        <div class="header-element">
                            <!-- Start::header-link -->
                            <a href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                                <span class="open-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
                                        viewBox="0 0 24 24">
                                        <path d="M24 0v24H0V0h24z" fill="none" opacity=".87" />
                                        <path
                                            d="M18.41 16.59L13.82 12l4.59-4.59L17 6l-6 6 6 6 1.41-1.41zM6 6h2v12H6V6z" />
                                    </svg>
                                </span>
                                <span class="close-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" viewBox="0 0 24 24"
                                        fill="#000000">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                    </svg>
                                </span>
                            </a>
                            <!-- End::header-link -->
                        </div>
                        <!-- End::header-element -->
                    </div>
                    <!-- End::header-content-left -->

                    <!-- Start::header-content-right -->
                    <div class="header-content-right">
                        <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                            aria-controls="navbarSupportedContent-4" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                        </button>
                        <div class="navbar navbar-collapse responsive-navbar p-0">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                <div class="d-flex align-items-center">
                                    <!-- Start::header-element -->

                                    <!-- Start::header-element -->
                                    <div class="header-element header-theme-mode">
                                        <!-- Start::header-link|layout-setting -->
                                        <a href="javascript:void(0);" class="header-link layout-setting">
                                            <span class="light-layout">
                                                <!-- Start::header-link-icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="header-link-icon" viewBox="0 0 24 24">
                                                    <g>
                                                        <rect fill="none" height="24" width="24" />
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M19.78,17.51c-2.47,0-6.57-1.33-8.68-5.43C8.77,7.57,10.6,3.6,11.63,2.01C6.27,2.2,1.98,6.59,1.98,12 c0,0.14,0.02,0.28,0.02,0.42C2.61,12.16,3.28,12,3.98,12c0,0,0,0,0,0c0-3.09,1.73-5.77,4.3-7.1C7.78,7.09,7.74,9.94,9.32,13 c1.57,3.04,4.18,4.95,6.8,5.86c-1.23,0.74-2.65,1.15-4.13,1.15c-0.5,0-1-0.05-1.48-0.14c-0.37,0.7-0.94,1.27-1.64,1.64 c0.98,0.32,2.03,0.5,3.11,0.5c3.5,0,6.58-1.8,8.37-4.52C20.18,17.5,19.98,17.51,19.78,17.51z" />
                                                            <path
                                                                d="M7,16l-0.18,0C6.4,14.84,5.3,14,4,14c-1.66,0-3,1.34-3,3s1.34,3,3,3c0.62,0,2.49,0,3,0c1.1,0,2-0.9,2-2 C9,16.9,8.1,16,7,16z" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                <!-- End::header-link-icon -->
                                            </span>
                                            <span class="dark-layout">
                                                <!-- Start::header-link-icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    enable-background="new 0 0 24 24" class="header-link-icon"
                                                    viewBox="0 0 24 24">
                                                    <rect fill="none" height="24" width="24" />
                                                    <path
                                                        d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z" />
                                                </svg>
                                                <!-- End::header-link-icon -->
                                            </span>
                                        </a>
                                        <!-- End::header-link|layout-setting -->
                                    </div>
                                    <!-- End::header-element -->

                                    <!-- Start::header-element -->
                                    <div class="header-element header-search ">
                                        <!-- Start::header-link -->
                                        <a href="javascript:void(0);" class="header-link d-lg-none d-block"
                                            data-bs-toggle="modal" data-bs-target="#searchModal">
                                            <!-- <i class="bi bi-search-alt-2   ps-0"></i> -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
                                                viewBox="0 0 24 24" width="24px">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                            </svg>
                                        </a>
                                        <!-- End::header-link -->
                                    </div>
                                    <!-- End::header-element -->

                                    <!-- Start::header-element notification -->
                                    {{-- <div class="header-element dropdown-center notifications-dropdown">
                                        <!-- Start::header-link|dropdown-toggle -->
                                        <a href="javascript:void(0);" class="header-link dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
                                                viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
                                            </svg>
                                            <span
                                                class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary"
                                                id="notification-icon-badge">4</span>
                                        </a>
                                        <!-- End::header-link|dropdown-toggle -->
                                        <!-- Start::main-header-dropdown -->
                                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                                            data-popper-placement="none">
                                            <div class="p-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="mb-0 fs-15 fw-semibold">Notifications</p>
                                                    <a href="javascript:void(0);" class="badge bg-secondary-transparent"
                                                        id="notifiation-data">4 Items</a>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider my-0"></div>
                                            <ul class="list-unstyled mb-0">
                                                <li class="dropdown-item mb-1">
                                                    <div class="d-flex align-items-start">
                                                        <div class="pe-2">
                                                            <span class="avatar avatar-md bg-primary rounded-circle"><i
                                                                    class="ti ti-gift fs-18"></i></span>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div
                                                                class="d-flex align-items-start justify-content-between">
                                                                <div>
                                                                    <a href="notify-list.html"
                                                                        class="mb-0 fs-13 font-weight-semibold text-dark">Nile
                                                                        Robetz send to a HTML file for Upload</a>
                                                                    <div class="p-1 text-warning">
                                                                        <span class="fs-12 me-2"><i
                                                                                class="bi bi-folder2-open me-1 fs-14"></i>HTML
                                                                            File</span>
                                                                        <span class="fs-13"><i
                                                                                class="bi bi-download"></i></span>
                                                                    </div>
                                                                </div>
                                                                <a href="javascript:void(0);"
                                                                    class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
                                                                        class="ti ti-x fs-16"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item mb-1">
                                                    <div class="d-flex align-items-start">
                                                        <div class="pe-2">
                                                            <span
                                                                class="avatar avatar-md bg-secondary rounded-circle"><i
                                                                    class="ti ti-discount-2 fs-18"></i></span>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div
                                                                class="d-flex align-items-start justify-content-between">
                                                                <div>
                                                                    <a href="notify-list.html"
                                                                        class="mb-0 fs-13 font-weight-semibold text-dark">Conference
                                                                        meeting about client project</a>
                                                                    <div class="p-1">
                                                                        <span class="fs-11 text-muted me-3"><i
                                                                                class="bi bi-calendar me-1"></i>Monday -
                                                                            11:00 AM - 45 minutes</span>
                                                                    </div>
                                                                    <a href="profile.html"
                                                                        class="d-flex align-items-center mt-1">
                                                                        <span class="avatar avatar-sm brround">
                                                                            <img src="../assets/images/users/1.jpg"
                                                                                class="brround" alt="img">
                                                                        </span>
                                                                        <span class="ms-2 fs-13 text-gray-600">Nile
                                                                            Rebort</span>
                                                                    </a>
                                                                </div>
                                                                <a href="javascript:void(0);"
                                                                    class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
                                                                        class="ti ti-x fs-16"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item mb-1">
                                                    <div class="d-flex align-items-start">
                                                        <div class="pe-2">
                                                            <span class="avatar avatar-md bg-pink rounded-circle"><i
                                                                    class="ti ti-user-check fs-18"></i></span>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div
                                                                class="d-flex align-items-start justify-content-between">
                                                                <a href="notify-list.html"
                                                                    class="mb-0 fs-13 font-weight-semibold text-dark">Taylor
                                                                    invite to a design channel</a>
                                                                <a href="javascript:void(0);"
                                                                    class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
                                                                        class="ti ti-x fs-16"></i></a>
                                                            </div>
                                                            <div class="fs-12">
                                                                <small class="text-muted fs-12">Hi, can i change my
                                                                    commission amount?</small>
                                                                <div class="mt-2">
                                                                    <button type="button"
                                                                        class="btn btn-primary-light btn-sm me-1 fs-11">Accept</button>
                                                                    <button type="button"
                                                                        class="btn btn-danger-light btn-sm fs-11">Reject</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item mb-1">
                                                    <div class="d-flex align-items-start">
                                                        <div class="pe-2">
                                                            <span class="avatar avatar-md bg-warning rounded-circle"><i
                                                                    class="ti ti-circle-check fs-18"></i></span>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div
                                                                class="d-flex align-items-start justify-content-between">
                                                                <a href="notify-list.html"
                                                                    class="mb-0 fs-13 font-weight-semibold text-dark">Order
                                                                    Placed <span class="text-primary">ID:
                                                                        #1116773</span></a>
                                                                <a href="javascript:void(0);"
                                                                    class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
                                                                        class="ti ti-x fs-16"></i></a>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-center justify-conent-between fs-12">
                                                                <span class="text-muted">Order Placed
                                                                    Successfully</span>
                                                                <span
                                                                    class="align-self-end min-w-fit-content text-muted mg-s-5">12:46</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <!-- <div class="dropdown-divider"></div> -->
                                            <div class="p-3 empty-header-item1">
                                                <div class="d-grid">
                                                    <a href="notify-list.html" class="btn btn-primary">View All</a>
                                                </div>
                                            </div>
                                            <div class="p-5 empty-item1 d-none">
                                                <div class="text-center">
                                                    <span class="avatar avatar-xl rounded-2 bg-secondary-transparent">
                                                        <i class="ri-notification-off-line fs-2"></i>
                                                    </span>
                                                    <h6 class="fw-semibold mt-3">No New Notifications</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End::main-header-dropdown -->
                                    </div> --}}
                                    <!-- End::header-element -->

                                    <!-- Start::header-element -->
                                    {{-- <div class="header-element dropdown-center header-shortcuts-dropdown">
                                        <!-- Start::header-link|dropdown-toggle -->
                                        <a href="javascript:void(0);" class="header-link dropdown-toggle"
                                            data-bs-toggle="dropdown" id="notificationDropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
                                                viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z" />
                                            </svg>
                                        </a>
                                        <!-- End::header-link|dropdown-toggle -->
                                        <!-- Start::main-header-dropdown -->
                                        <div class="main-header-dropdown header-shortcuts-dropdown dropdown-menu pb-0 dropdown-menu-end"
                                            aria-labelledby="notificationDropdown">
                                            <div class="p-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="mb-0 fs-17 fw-semibold">Related Apps</p>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider my-0"></div>
                                            <div class="main-header-shortcuts py-1 px-4" id="header-shortcut-scroll">
                                                <div class="row">
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="chat.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i
                                                                        class="mdi mdi-message-outline text-primary fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Chat</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="file-manager.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i
                                                                        class="mdi mdi-file-multiple-outline text-info fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Files</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="calendar2.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i
                                                                        class="mdi mdi-calendar-range-outline text-warning fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Calendar</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="settings.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i class="mdi mdi-cog-outline text-info fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Settings</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="faq.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i
                                                                        class="mdi mdi-help-circle-outline text-success fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Help</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="profile.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i
                                                                        class="mdi mdi-account-outline text-primary fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Profile</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="about.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i class="mdi mdi-phone text-primary fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Contact</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="rating.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i
                                                                        class="mdi mdi-comment-quote-outline text-secondary fs-24"></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Feeback</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 p-1 mt-0">
                                                        <a href="login.html">
                                                            <div class="text-center p-3 related-app border rounded-2">
                                                                <span>
                                                                    <i class="mdi mdi-logout text-warning fs-24 "></i>
                                                                </span>
                                                                <span class="d-block fs-12 text-dark">Logout</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-3 border-top">
                                                <div class="d-grid">
                                                    <a href="javascript:void(0);" class="btn btn-primary">View All</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End::main-header-dropdown -->
                                    </div> --}}
                                    <!-- End::header-element -->

                                    <!-- Start::header-element -->
                                    <div class="header-element header-fullscreen">
                                        <!-- Start::header-link -->
                                        <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="header-link-icon full-screen-open" viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                class="header-link-icon full-screen-close d-none" viewBox="0 0 24 24"
                                                width="24px" fill="none">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z" />
                                            </svg>
                                        </a>
                                        <!-- End::header-link -->
                                    </div>
                                    <!-- End::header-element -->

                                    <!-- Start::header-element|main-profile-user -->
                                    <div class="header-element main-profile-user">
                                        <!-- Start::header-link|dropdown-toggle -->
                                        <a href="javascript:void(0);" class="header-link dropdown-toggle d-flex align-items-center"
                                            id="mainHeaderProfile" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="me-2">
                                                <img src="../assets/images/users/21.jpg" alt="img" width="30"
                                                    height="30" class="rounded-circle">
                                            </span>
                                            <div class="d-xl-block d-none lh-1">
                                                <h6 class="fs-13 font-weight-semibold mb-0">{{ auth()->user()->name }}</h6>
                                                <span class="op-8 fs-10">{{ auth()->user()->email }}</span>
                                            </div>
                                        </a>
                                        <!-- End::header-link|dropdown-toggle -->
                                        <ul class="dropdown-menu pt-0 overflow-hidden dropdown-menu-end mt-1"
                                            aria-labelledby="mainHeaderProfile">
                                            <li><a class="dropdown-item" href="profile.html"><i
                                                        class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                                            <li><a class="dropdown-item" href="login.html"><i
                                                        class="ti ti-power fs-18 me-2 op-7"></i>Sign Out</a></li>
                                            <li>
                                                <hr class="dropdown-divider my-0">
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- End::header-element|main-profile-user -->


                                </div>
                            </div>
                        </div>
                        <!-- Start::header-element -->
                        <div class="header-element">
                            <!-- Start::header-link|switcher-icon -->
                            <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas"
                                data-bs-target="#switcher-canvas">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    class="header-link-icon fa-spin">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                                </svg>
                            </a>
                            <!-- End::header-link|switcher-icon -->
                        </div>
                        <!-- End::header-element -->

                    </div>
                    <!-- End::header-content-right -->
                </div>
                <!-- End::main-header-container -->

            </header>
            <!-- /app-header -->
            <!-- Start::app-sidebar -->
            <aside class="app-sidebar sticky" id="sidebar">

                <!-- Start::main-sidebar-header -->
                <div class="main-sidebar-header">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="desktop-logo">
                        <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="toggle-logo">
                        <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="desktop-dark">
                        <img src="{{ asset('assets/web_image/happy_technology_logo.png') }}" alt="logo" class="toggle-dark">
                    </a>
                </div>
                <!-- End::main-sidebar-header -->

                <!-- Start::main-sidebar -->
                <div class="main-sidebar" id="sidebar-scroll">

                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                            </svg>
                        </div>
                        <ul class="main-menu">
                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Main</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="{{route('home')}}" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#000000">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z" />
                                    </svg>
                                    <span class="side-menu__label">Dashboard</span>
                                </a>
                            </li>
                            <!-- End::slide -->
                            @canany(['contract-type-list','manage-party-list','manage-amc-list','manage-receipt-list','manage-tax-list','amc-expiry-reminder-list','party-ledger-summary-list','party-ledger-details-list','payment-pending-report-list','service-tax-report-list'])
                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">AMC</span></li>
                                <!-- End::slide__category -->

                                <!-- Start::slide -->
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="side-menu__icon">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path
                                                d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z">
                                            </path>
                                        </svg>
                                        <span class="side-menu__label">AMC</span>
                                        <i class="fe fe-chevron-right side-menu__angle"></i>
                                    </a>
                                    <ul class="slide-menu child1">
                                        <li class="slide side-menu__label1">
                                            <a href="javascript:void(0);">AMC</a>
                                        </li>
                                        @can('contract-type-list')
                                            <li class="slide">
                                                <a href="{{ route('contract_type.index') }}" class="side-menu__item">Manage AMC Contract Product</a>
                                            </li>
                                        @endcan
                                        @can('manage-party-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_party.index') }}" class="side-menu__item">Manage Party</a>
                                            </li>
                                        @endcan
                                        @can('manage-amc-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_amc.index') }}" class="side-menu__item">Manage AMC</a>
                                            </li>
                                        @endcan
                                        @can('manage-receipt-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_receipt.index') }}" class="side-menu__item">Manage Receipt</a>
                                            </li>
                                        @endcan
                                        @can('manage-tax-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_tax.index') }}" class="side-menu__item">Manage Tax</a>
                                            </li>
                                        @endcan
                                        @can('amc-expiry-reminder-list')
                                            <li class="slide">
                                                <a href="{{ route('amc_expiry_reminder') }}" class="side-menu__item">AMC Expiry Reminder</a>
                                            </li>
                                        @endcan
                                        @can('party-ledger-summary-list')
                                            <li class="slide">
                                                <a href="{{ route('party_ledger_summary') }}" class="side-menu__item">Party Leadger Summary Report</a>
                                            </li>
                                        @endcan
                                        @can('party-ledger-details-list')
                                            <li class="slide">
                                                <a href="{{ route('party_ledger_details') }}" class="side-menu__item">Party Leadger Detail Report</a>
                                            </li>
                                        @endcan
                                        @can('payment-pending-report-list')
                                            <li class="slide">
                                                <a href="{{ route('payment_pending_report.index') }}" class="side-menu__item">Payment Pending Report</a>
                                            </li>
                                        @endcan
                                        @can('service-tax-report-list')
                                            <li class="slide">
                                                <a href="{{ route('service_tax_report.index') }}" class="side-menu__item">Service Tax Report</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <!-- End::slide -->
                            @endcanany
                            @canany(['manage-complaint-template-list','manage-solution-template-list','manage-executive-list','manage-complaint-list','call-register-list','complaint-summary-list'])

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Call Management</span></li>
                                <!-- End::slide__category -->
                                <!-- Start::slide -->
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                            width="24px" class="side-menu__icon" fill="#000000">
                                            <path
                                                d="M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z">
                                            </path>
                                        </svg>
                                        <span class="side-menu__label">Call Management</span>
                                        <i class="fe fe-chevron-right side-menu__angle"></i>
                                    </a>
                                    <ul class="slide-menu child1">
                                        <li class="slide side-menu__label1">
                                            <a href="javascript:void(0);">Call Management</a>
                                        </li>
                                        @can('manage-complaint-template-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_complaint_template.index') }}" class="side-menu__item">Complant Template</a>
                                            </li>
                                        @endcan
                                        @can('manage-solution-template-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_solution_template.index') }}" class="side-menu__item">Solution Template</a>
                                            </li>
                                        @endcan
                                        @can('manage-executive-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_executive.index') }}" class="side-menu__item">Manage Executive</a>
                                            </li>
                                        @endcan
                                        @can('manage-complaint-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_complaint.index') }}" class="side-menu__item">Manage Complaint</a>
                                            </li>
                                        @endcan
                                        @can('call-register-list')
                                            <li class="slide">
                                                <a href="{{ route('call_register') }}" class="side-menu__item">Call Register</a>
                                            </li>
                                        @endcan
                                        @can('complaint-summary-list')
                                            <li class="slide">
                                                <a href="{{ route('complaint_summary') }}" class="side-menu__item">Complaint Summary</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <!-- End::slide -->
                            @endcanany
                            @canany(['product-group-list','manage-product-list','manage-supplier-list','manage-inward-list','manage-outward-list','stock-register-list','month-wise-item-stock-list','minimum-item-stock-report-list'])

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Stock Management</span></li>
                                <!-- End::slide__category -->

                                <!-- Start::slide -->
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                            width="24px" class="side-menu__icon" fill="#000000">
                                            <path
                                                d="M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z">
                                            </path>
                                        </svg>
                                        <span class="side-menu__label">Stock Management</span>
                                        <i class="fe fe-chevron-right side-menu__angle"></i>
                                    </a>
                                    <ul class="slide-menu child1">
                                        <li class="slide side-menu__label1">
                                            <a href="javascript:void(0);">Stock Management</a>
                                        </li>
                                        @can('product-group-list')
                                            <li class="slide">
                                                <a href="{{ route('product_group.index') }}" class="side-menu__item">Product Group</a>
                                            </li>
                                        @endcan
                                        @can('manage-product-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_product.index') }}" class="side-menu__item">Manage Product</a>
                                            </li>
                                        @endcan
                                        @can('manage-supplier-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_supplier.index') }}" class="side-menu__item">Manage Supplier</a>
                                            </li>
                                        @endcan
                                        @can('manage-inward-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_inward.index') }}" class="side-menu__item">Manage Inward</a>
                                            </li>
                                        @endcan
                                        @can('manage-outward-list')
                                            <li class="slide">
                                                <a href="{{ route('manage_outward.index') }}" class="side-menu__item">Manage Outward</a>
                                            </li>
                                        @endcan
                                        @can('stock-register-list')
                                            <li class="slide">
                                                <a href="{{ route('stock_register') }}" class="side-menu__item">Stock Register</a>
                                            </li>
                                        @endcan
                                        @can('month-wise-item-stock-list')
                                            <li class="slide">
                                                <a href="{{ route('month_wise_item_stock') }}" class="side-menu__item">Month Wise Item Stock</a>
                                            </li>
                                        @endcan
                                        @can('minimum-item-stock-report-list')
                                            <li class="slide">
                                                <a href="{{ route('minimum_item_stock_report') }}" class="side-menu__item">Minimum Item Stock Report</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <!-- End::slide -->
                            @endcanany
                            @canany(['role-list','user-list'])

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Administrator   </span></li>
                                <!-- End::slide__category -->

                                <!-- Start::slide -->
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                            width="24px" class="side-menu__icon" fill="#000000">
                                            <path
                                                d="M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z">
                                            </path>
                                        </svg>
                                        <span class="side-menu__label">Administrator</span>
                                        <i class="fe fe-chevron-right side-menu__angle"></i>
                                    </a>
                                    <ul class="slide-menu child1">
                                        <li class="slide side-menu__label1">
                                            <a href="javascript:void(0);">Administrator</a>
                                        </li>
                                        @can('role-list')
                                            <li class="slide">
                                                <a href="{{ route('roles.index') }}" class="side-menu__item">User Role</a>
                                            </li>
                                        @endcan
                                        @can('user-list')
                                            <li class="slide">
                                                <a href="{{ route('users.index') }}" class="side-menu__item">Users</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <!-- End::slide -->
                            @endcanany
                        </ul>
                        <div class="slide-right d-none" id="slide-right">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                </path>
                            </svg>
                        </div>
                    </nav>
                    <!-- End::nav -->

                </div>
                <!-- End::main-sidebar -->

            </aside>
            <!-- End::app-sidebar -->

            <div class="main-content app-content mt-0">
                @yield('content')
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © <span id="year"></span> <a href="javascript:void(0);">Happy technology</a> <span
                            class="fa fa-heart text-danger"></span> All
                        rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER CLOSED -->
        <!-- Scroll To Top -->
        <div class="scrollToTop">
            <span class="arrow"><i class="fa fa-angle-up fs-20"></i></span>
        </div>
        <!-- Scroll To Top -->
        <div id="responsive-overlay"></div>
        <!-- Popper JS -->
        <script src="{{ asset('dist/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Defaultmenu JS -->
        <script src="{{ asset('dist/assets/js/defaultmenu.min.js') }}"></script>
        <!-- Node Waves JS-->
        <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>
        <!-- Sticky JS -->
        <script src="{{ asset('dist/assets/js/sticky.js') }}"></script>
        <!-- Simplebar JS -->
        <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('dist/assets/js/simplebar.js') }}"></script>
        <!-- Color Picker JS -->
        <script src="{{ asset('dist/assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
        <!-- INTERNAL APEXCHART JS -->
        <script src="{{ asset('dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <!-- Color Picker JS -->
        <script src="{{ asset('dist/assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
        <!-- Checkbox selectall JS -->
        <script src="{{ asset('dist/assets/js/checkbox-selectall.js') }}"></script>
        <!-- INTERNAL INDEX JS -->
        <script src="{{ asset('dist/assets/js/index1.js') }}"></script>
        <!-- Custom-Switcher JS -->
        <script src="{{ asset('dist/assets/js/custom-switcher.min.js') }}"></script>
        <!-- CUSTOM JS -->
        <script src="{{ asset('dist/assets/js/custom.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
        <!-- Bootstrap datepicker JS-->
        <script src="{{ asset('assets/datepicker/bootstrap-datepicker.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js-script')
    </body>
</html>
