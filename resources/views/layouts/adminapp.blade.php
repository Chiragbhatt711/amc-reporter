<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AMC Reporter') }}</title>
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Bootstrap datepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/datepicker/bootstrap-datepicker.min.css') }}">

        {{-- JQuery Data table css --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/responsive.dataTables.min.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand logo_div" href="#">
                        <img src="{{ asset('assets/image/logo_amc.png') }}" class="logo" alt="Logo" loading="lazy" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse menus" id="main_nav">
                        <ul class="navbar-nav">
                            <li  class="nav-item dropdown">
                                <a class="nav-link" href="{{route('home')}}"><i class='fa fa-home'></i>Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"><i class='fa fa-gears'></i>AMC</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('contract_type.index') }}">
                                            <i class="fas fa-file"></i> Manage AMC Contract Product
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('manage_party.index') }}">
                                            <i class="fa fa-users" aria-hidden="true"></i> Manage Party
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('manage_amc.index') }}">
                                            <i class="fa fa-cog" aria-hidden="true"></i>Manage AMC
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('manage_receipt.index') }}">
                                            <i class="fas fa-dollar-sign"></i>Manage Receipt
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ Route('manage_tax.index') }}">
                                            <i class="fa fa-percent" aria-hidden="true"></i>Manage Tax
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ Route('amc_expiry_reminder') }}">
                                        <i class="fa-solid fa-calendar-clock"></i>AMC Expiry Reminder
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="#">
                                        <i class=""></i>Party Leadger Summary Report
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="#">
                                        <i class=""></i>Party Leadger Detail Report
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="#">
                                        <i class=""></i>Payment Pending Report
                                        </a>
                                    </li>
    
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#">
                                    <i class="fa fa-phone" aria-hidden="true"></i>Call Management
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="#">
                                            <i class=""></i>Complant Template
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown" >
                                <a class="nav-link dropdown-toggle" href="#">
                                    <i class="fa fa-pie-chart" aria-hidden="true"></i>Stock Management
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="#"> Dropdown item 1 </a>
                                    </li>
                                </ul>
                            </li>
                            @canany(['role-list','user-list'])
                                <li class="nav-item dropdown" >
                                    <a class="nav-link dropdown-toggle" href="#">
                                        <i class="fa-solid fa-user-group"></i>Administrator
                                    </a>
                                    <ul class="dropdown-menu">
                                        @can('role-list')
                                            <li class="dropdown-item">
                                                <a class="nav-link" href="{{ Route('roles.index') }}">
                                                    <i class="fa-solid fa-user"></i>User Role
                                                </a>
                                            </li>
                                        @endcan
                                        @can('user-list')
                                            <li class="dropdown-item">
                                                <a class="nav-link" href="{{ Route('users.index') }}">
                                                    <i class="fa-solid fa-user"></i>Users
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcanany
                            <li class="nav-item log_out">
                                <a class="nav-link" href="{{ Route('logout') }}" title="Log Out">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer>
        <div class="footer">
            <div class="conatiner">
                <div class="footer-area">
                    <p>&copy; All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
        <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Bootstrap datepicker JS-->
    <script src="{{ asset('assets/datepicker/bootstrap-datepicker.min.js') }}"></script>
    {{-- JQuery Data table js --}}
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/DataTables/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/DataTables/dataTables_sum.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js-script')
</body>
</html>
