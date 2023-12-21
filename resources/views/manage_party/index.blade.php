@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Manage Party</h1>
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
                        @can('manage-party-create')
                            <a class="btn btn-primary btn-block float-end my-2" href="{{ route('manage_party.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <table class="table table-bordered dynamic-data-table">
                            <thead  class="">
                                <tr>
                                    <th scope="col">Party Name</th>
                                    <th scope="col">Contact Person Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Mobile No</th>
                                    <th scope="col">Phone No</th>
                                    <th scope="col">Pincode</th>
                                    <th scope="col">E-mail</th>
                                    {{-- <th scope="col">extf1</th>
                                    <th scope="col">extf2</th>
                                    <th scope="col">extf3</th>
                                    <th scope="col">extf4</th>
                                    <th scope="col">extf5</th> --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($manageParty) && $manageParty)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($manageParty as $value)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td data-label="Party Name">{{ $value->party_name }}</td>
                                            <td data-label="Contact Person Name">{{ $value->contact_person_name }}</td>
                                            <td data-label="Address">{{ $value->address }}</td>
                                            <td data-label="City">{{ $value->city }}</td>
                                            <td data-label="State">{{ $value->state }}</td>
                                            <td data-label="Country">{{ $value->country }}</td>
                                            <td data-label="Mobile No">{{ $value->mobile_no }}</td>
                                            <td data-label="Phone No">{{ $value->phone_no }}</td>
                                            <td data-label="Pincode">{{ $value->pincode }}</td>
                                            <td data-label="E-mail">{{ $value->email }}</td>
                                            {{-- <td data-label="extf1">{{ $value->extf_1 }}</td>
                                            <td data-label="extf2">{{ $value->extf_2 }}</td>
                                            <td data-label="extf3">{{ $value->extf_3 }}</td>
                                            <td data-label="extf4">{{ $value->extf_4 }}</td>
                                            <td data-label="extf5">{{ $value->extf_5 }}</td> --}}
                                            <td data-label="Action">
                                                @can('manage-party-edit')
                                                    <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('manage_party.edit',$value->id)}}"> <i class="bi bi-pencil-square" aria-hidden="true"></i> </a>
                                                @endcan
                                                @can('manage-party-delete')
                                                    <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="bi bi-trash" aria-hidden="true"></i> </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are sure want to delete</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                <input type="submit" class="btn btn-primary" value="Delete">
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
<!-- CONTAINER CLOSED -->
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("manage_party") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
