@extends('layouts.adminapp')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
    <h1 class="page-title">Users</h1>
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
                        {{--  @can('product-group-create')
                            <a class="btn btn-primary" href="{{ route('users.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endcan  --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id="grid-pagination">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead  class="gridjs-thead">
                                        <tr>
                                        <th class="gridjs-th" data-column-id="No">No</th>
                                        <th class="gridjs-th" data-column-id="Name">Name</th>
                                        <th class="gridjs-th" data-column-id="Email">Email</th>
                                        <th class="gridjs-th" data-column-id="Mobile No">Mobile No</th>
                                        <th class="gridjs-th" data-column-id="Role">Role</th>
                                        <th class="gridjs-th" data-column-id="Action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($users) && $users)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($users as $value)
                                                @php
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td class="gridjs-td" data-column-id="No">{{ $i }}</td>
                                                    <td class="gridjs-td" data-column-id="Name">{{ $value->name }}</td>
                                                    <td class="gridjs-td" data-column-id="Email">{{ $value->email }}</td>
                                                    <td class="gridjs-td" data-column-id="Mobile No">{{ $value->mobile_number }}</td>
                                                    <td class="gridjs-td" data-column-id="Role">{{ $value->role }}</td>
                                                    <td class="gridjs-td" data-column-id="Action">
                                                        @can('user-edit')
                                                            <a class="btn btn-sm btn-icon btn-info-light rounded-circle" href="{{Route('users.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                        @endcan
                                                        @can('user-delete')
                                                            <a class="btn btn-sm btn-icon btn-secondary-light rounded-circle" onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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
                <button type="button" class="btn btn_tile" data-bs-dismiss="modal">Cancel</button>
                {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                    <input type="submit" class="btn btn-primary" value="Delete">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection

@section('js-script')
<script>
    function deleteFunction(id){
        $('#deleteForm').attr('action','{{ url("users") }}'+ '/'+id);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
