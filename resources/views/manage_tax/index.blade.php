@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage Tax</h3>
        <!-- <div class="pull-right"> -->
            <a class="btn add_btn" href="{{ route('manage_tax.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        <!-- </div> -->
    </div>
    <table class="table table-bordered dynamic-data-table">
        <thead  class="">
            <tr>
            <th scope="col">Tax Profile Name</th>
            <th scope="col">Tax Lable Name</th>
            <th scope="col">Tax Caption 1</th>
            <th scope="col">Tax 1(%)</th>
            <th scope="col">Tax Caption 2</th>
            <th scope="col">Tax 2(%)</th>
            <th scope="col">Tax Caption 3</th>
            <th scope="col">Tax 3(%)</th>
            <th scope="col">Tax Caption 4</th>
            <th scope="col">Tax 4(%)</th>
            <th scope="col">Tax Caption 5</th>
            <th scope="col">Tax 5(%)</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($tax) && $tax)
                @php
                    $i = 0;
                @endphp
                @foreach ($tax as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td data-label="Tax Profile Name">{{ $value->profile_name }}</td>
                        <td data-label="Tax Lable Name">{{ $value->tax_lable_name }}</td>
                        <td data-label="Tax Caption 1">{{ $value->tax_caption_1 }}</td>
                        <td data-label="Tax 1(%)">{{ $value->tax_percentage_1 }}</td>
                        <td data-label="Tax Caption 2">{{ $value->tax_caption_2 }}</td>
                        <td data-label="Tax 2(%)">{{ $value->tax_percentage_2 }}</td>
                        <td data-label="Tax Caption 3">{{ $value->tax_caption_3 }}</td>
                        <td data-label="Tax 3(%)">{{ $value->tax_percentage_3 }}</td>
                        <td data-label="Tax Caption 4">{{ $value->tax_caption_4 }}</td>
                        <td data-label="Tax 4(%)">{{ $value->tax_percentage_4 }}</td>
                        <td data-label="Tax Caption 5">{{ $value->tax_caption_5 }}</td>
                        <td data-label="Tax 5(%)">{{ $value->tax_percentage_5 }}</td>
                        <td data-label="Action">
                            @can('user-edit')
                                <a href="{{Route('manage_tax.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                            @endcan
                            @can('user-delete')
                                <a onclick="deleteFunction( '{{ $value->id }}')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="`modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>`
                <div class="modal-body">
                    <p>Are sure want to delete</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    {!! Form::open(['method' => 'DELETE','style'=>'display:inline','id'=>'deleteForm']) !!}
                        <input type="submit" class="btn " value="Delete">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

@section('js-script')
<script>
function deleteFunction(id){
    $('#deleteForm').attr('action','{{ url("manage_tax") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
