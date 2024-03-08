@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">License Management</h1>
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
    <!-- Start:: row-2 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        <a class="btn btn-primary btn-block float-end my-2" onclick="addNewLicense()">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr>
                                            <th  class="gridjs-th" data-column-id="No">No</th>
                                            <th  class="gridjs-th" data-column-id="Key">Key</th>
                                            <th  class="gridjs-th" data-column-id="Time Period">Time Period</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data) && $data)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($data as $value)
                                                @php $i++;  @endphp
                                                <tr>
                                                    <td class="gridjs-td" data-column-id="No">{{ $i }}</td>
                                                    <td class="gridjs-td" data-column-id="Key">{{ $value->key }}</td>
                                                    <td class="gridjs-td" data-column-id="Time Period">{{ $value->valid_day }} Days</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="addNewLicenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-1">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <strong class="valid_day">Time Period<em class="text-danger">*</em></strong>
                            <select name="valid_day" id="valid_day">
                                <option value="">Please select plan</option>
                                <option value="28">1 Month (28 days)</option>
                                <option value="84">3 Month (84 days)</option>
                                <option value="180">6 Month (180 days)</option>
                                <option value="365">1 Year (365 days)</option>
                            </select>
                            <div class="text-danger" id="valid_day_error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_tile" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn_tile" onclick="submit()">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection

@section('js-script')
<script>
    function addNewLicense(){
        $('#addNewLicenseModal').modal('show');
    }

    function submit(){
        $('#valid_day_error').html('');
        if($('#valid_day').val() == "") {
            $('#valid_day_error').html('Please select plan');
        } else {
            $.ajax({
                url: "{{ route('admin.license.store') }}",
                type:'POST',
                data:{
                        '_token' : $('meta[name="csrf-token"]').attr('content'),
                        valid_day:$('#valid_day').val(),
                },
                success:function(data) {
                    location.reload();
                }
            });
        }
    }
</script>
@endsection
