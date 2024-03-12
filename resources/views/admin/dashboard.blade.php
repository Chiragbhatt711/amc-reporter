@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Dashboard</h1>
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
        <div class="col-xxl-9">
            <div class="row">
                <div class="col-xxl-5 col-xl-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xxl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start flex-wrap gap-1">
                                        <div class="flex-grow-1">
                                            <p class="mb-0">Subscriptions </p>
                                            <span class="fs-5">{{ totalSubscriptions() }}</span>
                                            {{-- <span class="fs-12 text-success ms-1"><i
                                                    class="ti ti-trending-up mx-1"></i>0.5%</span> --}}
                                        </div>
                                        <div class="min-w-fit-content">
                                            <span class="avatar avatar-md br-5 bg-info-transparent">
                                                <i class="fe fe-user-plus fs-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection

@section('js-script')
<script>

</script>
@endsection
