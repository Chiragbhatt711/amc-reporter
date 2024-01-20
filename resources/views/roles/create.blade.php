@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage User Role</h1>
    {{-- <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">AMC Dashboard</li>
        </ol>
    </div> --}}
</div>
<!-- PAGE-HEADER END -->
<!-- CONTAINER -->
<div class="main-container container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Create
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'roles.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text( 'name', null, array('placeholder' =>'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- <div class="form-group"> -->
                                @if($permissions)
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <strong>Menu</strong>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <strong>Permissions</strong>
                                        </div>
                                    </div>
                                    @foreach ($permissions as $key => $permission)
                                    <div class="row">
                                        @php
                                            $mainTitle = "";
                                            $menuName = $key;

                                            if(trim(strtolower($key)) == 'role')
                                            {
                                                $menuName = 'role';
                                                $mainTitle = "Role";
                                            }
                                            if(trim(strtolower($key)) == 'user')
                                            {
                                                $menuName = 'user';
                                                $mainTitle = "User profile";
                                            }
                                            if(trim(strtolower($key)) == 'contract-type')
                                            {
                                                $menuName = 'contract-type';
                                                $mainTitle = "Contract type";
                                            }
                                            if(trim(strtolower($key)) == 'manage-party')
                                            {
                                                $menuName = 'manage-party';
                                                $mainTitle = "Manage party";
                                            }
                                            if(trim(strtolower($key)) == 'manage-amc')
                                            {
                                                $menuName = 'manage-amc';
                                                $mainTitle = "Mmanage AMC";
                                            }
                                            if(trim(strtolower($key)) == 'manage-receipt')
                                            {
                                                $menuName = 'manage-receipt';
                                                $mainTitle = "Manage receipt";
                                            }
                                            if(trim(strtolower($key)) == 'manage-tax')
                                            {
                                                $menuName = 'manage-tax';
                                                $mainTitle = "Manage tax";
                                            }
                                            if(trim(strtolower($key)) == 'amc-expiry-reminder')
                                            {
                                                $menuName = 'amc-expiry-reminder';
                                                $mainTitle = "AMC expiry reminder";
                                            }
                                            if(trim(strtolower($key)) == 'party-ledger-summary')
                                            {
                                                $menuName = 'party-ledger-summary';
                                                $mainTitle = "Party ledger summary";
                                            }
                                            if(trim(strtolower($key)) == 'party-ledger-details')
                                            {
                                                $menuName = 'party-ledger-details';
                                                $mainTitle = "Party ledger details";
                                            }
                                            if(trim(strtolower($key)) == 'payment-pending-report')
                                            {
                                                $menuName = 'payment-pending-report';
                                                $mainTitle = "Payment pending report";
                                            }
                                            if(trim(strtolower($key)) == 'service-tax-report')
                                            {
                                                $menuName = 'service-tax-report';
                                                $mainTitle = "Service tax report";
                                            }
                                            if(trim(strtolower($key)) == 'manage-complaint-template')
                                            {
                                                $menuName = 'manage-complaint-template';
                                                $mainTitle = "Manage complaint template";
                                            }
                                            if(trim(strtolower($key)) == 'manage-solution-template')
                                            {
                                                $menuName = 'manage-solution-template';
                                                $mainTitle = "Manage solution template";
                                            }
                                            if(trim(strtolower($key)) == 'manage-executive')
                                            {
                                                $menuName = 'manage-executive';
                                                $mainTitle = "Manage executive";
                                            }
                                            if(trim(strtolower($key)) == 'manage-complaint')
                                            {
                                                $menuName = 'manage-complaint';
                                                $mainTitle = "Manage complaint";
                                            }
                                            if(trim(strtolower($key)) == 'call-register')
                                            {
                                                $menuName = 'call-register';
                                                $mainTitle = "Call register";
                                            }
                                            if(trim(strtolower($key)) == 'complaint-summary')
                                            {
                                                $menuName = 'complaint-summary';
                                                $mainTitle = "Complaint summary";
                                            }
                                            if(trim(strtolower($key)) == 'product-group')
                                            {
                                                $menuName = 'product-group';
                                                $mainTitle = "Product group";
                                            }
                                            if(trim(strtolower($key)) == 'manage-product')
                                            {
                                                $menuName = 'manage-product';
                                                $mainTitle = "Manage product";
                                            }
                                            if(trim(strtolower($key)) == 'manage-supplier')
                                            {
                                                $menuName = 'manage-supplier';
                                                $mainTitle = "Manage supplier";
                                            }
                                            if(trim(strtolower($key)) == 'manage-inward')
                                            {
                                                $menuName = 'manage-inward';
                                                $mainTitle = "Manage inward";
                                            }
                                            if(trim(strtolower($key)) == 'manage-outward')
                                            {
                                                $menuName = 'manage-outward';
                                                $mainTitle = "Manage outward";
                                            }
                                            if(trim(strtolower($key)) == 'stock-register')
                                            {
                                                $menuName = 'stock-register';
                                                $mainTitle = "Stock register";
                                            }
                                            if(trim(strtolower($key)) == 'month-wise-item-stock')
                                            {
                                                $menuName = 'month-wise-item-stock';
                                                $mainTitle = "Month wise item stock";
                                            }
                                            if(trim(strtolower($key)) == 'minimum-item-stock-report')
                                            {
                                                $menuName = 'minimum-item-stock-report';
                                                $mainTitle = "Minimum item stock report";
                                            }
                                            if(trim(strtolower($key)) == 'minimum-item-stock-report')
                                            {
                                                $menuName = 'minimum-item-stock-report';
                                                $mainTitle = "Minimum item stock report";
                                            }
                                        @endphp
                                        <div class="col-sm-12 col-md-5 col-lg-5">
                                            <strong>{{ $mainTitle }}</strong>
                                        </div>
                                        <div class="col-sm-12 col-md-7 col-lg-7">
                                            <div class="d-flex flex-row checkboxes">
                                                @foreach ($permission as $val)
                                                <div class="check d-flex flex-row align-items-center gap-2">
                                                    {{ Form::checkbox('permission[]', $val->id, false, ['class' => 'name','onclick'=>'permissionListAutoSelect(this)','data-id'=> $val->id,'data-name'=>$val->name,'data-menu-name'=>$menuName,'id'=>$val->name]) }}
                                                    {{$val->view_name}}
                                                    <label data-type="{{$val->name}}"></label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            <!-- </div> -->
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
