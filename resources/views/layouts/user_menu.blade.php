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
                    <li class="slide">
                        <a href="{{ route('brand.index') }}" class="side-menu__item">Brand</a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('model.index') }}" class="side-menu__item">Model</a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('group.index') }}" class="side-menu__item">Group</a>
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

        @if (auth()->user()->id == admin_id())
            @if (!checkLicenseActivate())
                <li class="slide">
                    <a data-bs-effect="effect-rotate-left" data-bs-toggle="modal"
                    href="#modaldemo8" class="modal-effect side-menu__item">
                        <i class="bi bi-key-fill side-menu__icon" style="height:26px;width:26px;color: #00a5a2;"></i>
                        <span class="side-menu__label">License Activate</span>
                    </a>
                </li>
            @endif
            <li class="slide">
                <a data-bs-effect="effect-rotate-left"
                href="{{ route('setting.index') }}" class="modal-effect side-menu__item">
                    <i class="bi bi-gear side-menu__icon" style="height:26px;width:26px;color: #00a5a2;"></i>
                    <span class="side-menu__label">General Settings</span>
                </a>
            </li>
        @endif
    </ul>
    <div class="slide-right d-none" id="slide-right">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
            </path>
        </svg>
    </div>
</nav>
