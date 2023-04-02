@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Party ledger summary</h3>
    </div>
    {!! Form::open(array('route' => 'party_ledger_summary','method'=>'GET')) !!}
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">Start Date</strong>
                    {!! Form::text('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">End Date</strong>
                    {!! Form::text('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-4">
                <button type="submit" class="btn btn_tile">Search</button>
            </div>
        </div>
    {!! Form::close() !!}
    <table class="table  table-bordered dynamic-data-table">
        <thead  class="">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Party Name</th>
              <th scope="col">Contact Person Name</th>
              <th scope="col">City</th>
              <th scope="col">AMC No</th>
              <th scope="col">Opening Balance</th>
              <th scope="col">Debit</th>
              <th scope="col">Credit</th>
              <th scope="col">Balance</th>
              {{-- <th scope="col">Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @if(isset($data) && $data)
                @php
                    $i = 0;
                @endphp
                @foreach ($data as $value)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td data-label="No">{{ $i }}</td>
                        <td data-label="Party Name">{{ $value->party_name }}</td>
                        <td data-label="Contact Person Name">{{ $value->contact_person_name }}</td>
                        <td data-label="City">{{ $value->city }}</td>
                        <td data-label="AMC No">{{ $value->id }}</td>
                        <td data-label="Opening Balance">{{ $value->opening_balance }}</td>
                        <td data-label="Debit">{{ $value->total_amount }}</td>
                        <td data-label="Credit">{{ $value->amount_recieve }}</td>
                        <td data-label="Balance">{{ $value->total_amount - $value->amount_recieve  }}</td>
                        {{-- <td data-label="Action">
                            <a href="{{Route('manage_amc.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td> --}}
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('js-script')
<script>
function deleteFunction(id){
    $('#deleteForm').attr('action','{{ url("manage_amc") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
