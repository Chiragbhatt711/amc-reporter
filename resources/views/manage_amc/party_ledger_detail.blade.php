@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Party Ledger Details</h3>
    </div>
    {!! Form::open(array('route' => 'party_ledger_details','method'=>'GET')) !!}
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">Look In</strong>
                    {!! Form::select('look_in', ['Part Wise'=>'Part Wise','AMC Wise'=>'AMC Wise'] , isset($_GET['look_in']) && $_GET['look_in'] ? $_GET['look_in'] : null, ['class' => 'form-select','id'=>'look_in' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">Start Date</strong>
                    {!! Form::text('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">End Date</strong>
                    {!! Form::text('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3" id="party_div" style="display: block;">
                <div class="form-group">
                    <strong class="lab_space">Party</strong>
                    {!! Form::select('party', $party , isset($_GET['party']) && $_GET['party'] ? $_GET['party'] : null, ['class' => 'form-select','placeholder'=>'Please select','id'=>'party' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3" id="amc_div" style="display: none;">
                <div class="form-group">
                    <strong class="lab_space">AMC</strong>
                    {!! Form::select('amc', $amcData , isset($_GET['amc']) && $_GET['amc'] ? $_GET['amc'] : null, ['class' => 'form-select','placeholder'=>'Please select','id'=>'amc' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-4">
                <button type="submit" class="btn btn_tile">Search</button>
            </div>
        </div>
    {!! Form::close() !!}
    <table class="table dynamic-data-table">
        <thead  class="">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Date</th>
              <th scope="col">Particular</th>
              <th scope="col">Debit</th>
              <th scope="col">Credit</th>
              <th scope="col">Balance</th>
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
                        <td>{{ $i }}</td>
                        <td>{{ $value->party_name }}</td>
                        <td>{{ $value->contact_person_name }}</td>
                        <td>{{ $value->city }}</td>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->opening_balance }}</td>
                        <td>{{ $value->total_amount }}</td>
                        <td>{{ $value->amount_recieve }}</td>
                        <td>{{ $value->total_amount - $value->amount_recieve  }}</td>
                        {{-- <td>
                            <a href="{{Route('manage_amc.edit',$value->id)}}"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td> --}}
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
@section('js-script')
<script>
$(document).ready(function(){
    $('#look_in').trigger('change');
})
$('#look_in').change(function(){
    if($('#look_in').val() == 'Part Wise')
    {
        $('#party_div').show();
        $('#amc_div').hide();
    }
    else
    {
        $('#party_div').hide();
        $('#amc_div').show();
    }
});
</script>
@endsection
