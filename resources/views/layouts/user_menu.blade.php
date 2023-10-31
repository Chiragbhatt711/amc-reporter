<li  class="nav-item dropdown">
    <a class="nav-link" href="{{route('home')}}"><i class='fa fa-home'></i>Dashboard</a>
</li>
@canany(['contract-type-list','manage-party-list','manage-amc-list','manage-receipt-list','manage-tax-list','amc-expiry-reminder-list','party-ledger-summary-list','party-ledger-details-list','payment-pending-report-list','service-tax-report-list'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="javascript:void(0)"><i class='fa fa-gears'></i>AMC</a>
        <ul class="dropdownMenu">
            @can('contract-type-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('contract_type.index') }}">
                        <i class=""></i> Manage AMC Contract Product
                    </a>
                </li>
            @endcan
            @can('manage-party-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_party.index') }}">
                        <i class="" aria-hidden="true"></i> Manage Party
                    </a>
                </li>
            @endcan
            @can('manage-amc-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_amc.index') }}">
                        <i class="" aria-hidden="true"></i>Manage AMC
                    </a>
                </li>
            @endcan
            @can('manage-receipt-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_receipt.index') }}">
                        <i class=""></i>Manage Receipt
                    </a>
                </li>
            @endcan
            @can('manage-tax-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ Route('manage_tax.index') }}">
                        <i class="" aria-hidden="true"></i>Manage Tax
                    </a>
                </li>
            @endcan
            @can('amc-expiry-reminder-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ Route('amc_expiry_reminder') }}">
                    <i class=""></i>AMC Expiry Reminder
                    </a>
                </li>
            @endcan
            @can('party-ledger-summary-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ Route('party_ledger_summary') }}">
                    <i class=""></i>Party Leadger Summary Report
                    </a>
                </li>
            @endcan
            @can('party-ledger-details-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ Route('party_ledger_details') }}">
                    <i class=""></i>Party Leadger Detail Report
                    </a>
                </li>
            @endcan
            @can('payment-pending-report-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('payment_pending_report.index') }}">
                    <i class=""></i>Payment Pending Report
                    </a>
                </li>
            @endcan
            @can('service-tax-report-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('service_tax_report.index') }}">
                    <i class=""></i>Service Tax Report
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['manage-complaint-template-list','manage-solution-template-list','manage-executive-list','manage-complaint-list','call-register-list','complaint-summary-list'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#">
            <i class="fa fa-phone" aria-hidden="true"></i>Call Management
        </a>
        <ul class="dropdownMenu">
            @can('manage-complaint-template-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_complaint_template.index') }}">
                        <i class=""></i>Complant Template
                    </a>
                </li>
            @endcan
            @can('manage-solution-template-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_solution_template.index') }}">
                        <i class=""></i>Solution Template
                    </a>
                </li>
            @endcan
            @can('manage-executive-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_executive.index') }}">
                        <i class=""></i>Manage Executive
                    </a>
                </li>
            @endcan
            @can('manage-complaint-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_complaint.index') }}">
                        <i class=""></i>Manage Complaint
                    </a>
                </li>
            @endcan
            @can('call-register-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('call_register') }}">
                        <i class=""></i>Call Register
                    </a>
                </li>
            @endcan
            @can('complaint-summary-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('complaint_summary') }}">
                        <i class=""></i>Complaint Summary
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['product-group-list','manage-product-list','manage-supplier-list','manage-inward-list','manage-outward-list','stock-register-list','month-wise-item-stock-list','minimum-item-stock-report-list'])
    <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#">
            <i class="fa fa-pie-chart" aria-hidden="true"></i>Stock Management
        </a>
        <ul class="dropdownMenu">
            @can('product-group-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('product_group.index') }}"> Product Group </a>
                </li>
            @endcan
            @can('manage-product-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_product.index') }}"> Manage Product </a>
                </li>
            @endcan
            @can('manage-supplier-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_supplier.index') }}"> Manage Supplier </a>
                </li>
            @endcan
            @can('manage-inward-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_inward.index') }}"> Manage Inward </a>
                </li>
            @endcan
            @can('manage-outward-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('manage_outward.index') }}"> Manage Outward </a>
                </li>
            @endcan
            @can('stock-register-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('stock_register') }}"> Stock Register </a>
                </li>
            @endcan
            @can('month-wise-item-stock-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('month_wise_item_stock') }}"> Month Wise Item Stock </a>
                </li>
            @endcan
            @can('minimum-item-stock-report-list')
                <li class="dropdown-item">
                    <a class="nav-link" href="{{ route('minimum_item_stock_report') }}"> Minimum Item Stock Report </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
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
    <li class="nav-item log_out">
        <a class="nav-link" href="{{ Route('logout') }}" title="Log Out">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>Log Out
        </a>
    </li>
@endcanany
