<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'AMC Reporter') }}</title> --}}
    <title>AMC Reporter</title>
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <!-- Bootstrap datepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/datepicker/bootstrap-datepicker.min.css') }}">

        {{-- JQuery Data table css --}}
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/responsive.dataTables.min.css') }}"> -->
        <style></style>
</head>
<body>
    <div id="app">
        <div id="full_page">
            <div class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <nav class="navbar navbar-expand-lg">
                                    <div class="container">
                                        <a class="navbar-brand logo_div" href="#">
                                            <img src="{{ asset('assets/image/happy_technology_logo.png') }}" class="logo" alt="Logo" loading="lazy" />
                                        </a>
                                        <button onclick="toggleMneu()" id="toogleBtn" class="navbar-toggler colleps-btn">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_side">
                <div class="container-fluid p-0">
                    <div class="d-flex">
                        <div id="mysidebar" class="sidebar shrink_sidebar">
                            <ul class="sidebar-navlink ">
                                <li  class="nav-item dropdown">
                                    <a class="nav-link" href="{{route('home')}}"><i class='fa fa-home'></i>Dashboard</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)"><i class='fa fa-gears'></i>AMC</a>
                                    <ul class="dropdownMenu">
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
                                            <a class="nav-link" href="{{ Route('party_ledger_summary') }}">
                                            <i class=""></i>Party Leadger Summary Report
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ Route('party_ledger_details') }}">
                                            <i class=""></i>Party Leadger Detail Report
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('payment_pending_report.index') }}">
                                            <i class=""></i>Payment Pending Report
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('service_tax_report.index') }}">
                                            <i class=""></i>Service Tax Report
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#">
                                        <i class="fa fa-phone" aria-hidden="true"></i>Call Management
                                    </a>
                                    <ul class="dropdownMenu">
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_complaint_template.index') }}">
                                                <i class=""></i>Complant Template
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_solution_template.index') }}">
                                                <i class=""></i>Solution Template
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_executive.index') }}">
                                                <i class=""></i>Manage Executive
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_complaint.index') }}">
                                                <i class=""></i>Manage Complaint
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('call_register') }}">
                                                <i class=""></i>Call Register
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('complaint_summary') }}">
                                                <i class=""></i>Complaint Summary
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown" >
                                    <a class="nav-link dropdown-toggle" href="#">
                                        <i class="fa fa-pie-chart" aria-hidden="true"></i>Stock Management
                                    </a>
                                    <ul class="dropdownMenu">
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('product_group.index') }}"> Product Group </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_product.index') }}"> Manage Product </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_supplier.index') }}"> Manage Supplier </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_inward.index') }}"> Manage Inward </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('manage_outward.index') }}"> Manage Outward </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('stock_register') }}"> Stock Register </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('month_wise_item_stock') }}"> Month Wise Item Stock </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('minimum_item_stock_report') }}"> Minimum Item Stock Report </a>
                                        </li>
                                    </ul>
                                </li>
                                @canany(['role-list','user-list'])
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#">
                                            <i class="fa-solid fa-user-group"></i>Administrator
                                        </a>
                                        <ul class="dropdownMenu">
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
                            <!-- <ul class="sidebar-navlink">
                                <li>
                                    <a href="#">
                                    <i class="fa-solid fa-house"></i>
                                    <span>Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa-solid fa-chart-simple"></i>
                                    <span>Analytics</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Activity</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa-solid fa-list-check"></i>
                                    <span>Mangement</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa-solid fa-users"></i>
                                    <span>Users</span>
                                    </a>
                                </li>
                            </ul> -->
                        </div>
                        <main class="container mt-4">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        var dropdown = document.getElementsByClassName("dropdown-toggle");
        var i;
        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
    <script>
    const mysidebar = document.getElementById("mysidebar");
    function toggleMneu() {
      mysidebar.classList.toggle("shrink_sidebar");
    }

    </script>

        <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Bootstrap datepicker JS-->
    <script src="{{ asset('assets/datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js-script')
</body>
</html>
