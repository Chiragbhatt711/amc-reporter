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
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">Look In</strong>
                    {!! Form::select('look_in', ['Part Wise'=>'Part Wise','AMC Wise'=>'AMC Wise'] , isset($_GET['look_in']) && $_GET['look_in'] ? $_GET['look_in'] : null, ['class' => 'form-select','id'=>'look_in' ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">Start Date</strong>
                    {!! Form::text('start_date', $startDate, array('placeholder' => 'Start Date' ,'class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="form-group">
                    <strong class="lab_space">End Date</strong>
                    {!! Form::text('end_date', $endDate, array('placeholder' => 'End Date' ,'class' => 'form-control datepicker')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" id="party_div" style="display: block;">
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 mt-lg-1">
                <button type="submit" class="btn btn_tile">Search</button>
            </div>
        </div>
    {!! Form::close() !!}
    <table class="table table-bordered dynamic-data-table">
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
            @php
                $i = 0;
                $party_opening_balance = 0;
            @endphp
            @if (isset($partyDetails) && $partyDetails)
                @php
                    $i++;
                    $party_opening_balance = $partyDetails->opening_balance;
                @endphp
                <tr>
                    <td data-label="No">{{ $i }}</td>
                    <td data-label="Date">{{ Carbon\Carbon::parse($partyDetails->created_at)->format('Y-m-d') }}</td>
                    <td data-label="Particular">Opening Balance</td>
                    <td data-label="Debit">{{ $partyDetails->opening_balance }}</td>
                    <td data-label="Credit">0</td>
                    <td data-label="Balance">{{ $partyDetails->opening_balance }}</td>
                </tr>
            @endif
            @if(isset($data) && $data)
                @foreach ($data as $value)
                    @php
                        $i++;
                        $totalAmount = $party_opening_balance + $value->total_amount;
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $value->start_date }}</td>
                        <td>{{ "Installment - AMC No.:".$value->id.", AMC Type : ".$value->amc_type.", Start Date : ".$value->start_date.", End Date : ".$value->end_date }}</td>
                        <td>{{ $value->total_amount }}</td>
                        <td>0</td>
                        <td>{{ $party_opening_balance + $value->total_amount }}</td>
                    </tr>
                    @php
                        $receipt = getAmcReceipt($value->id);
                    @endphp
                    @if(isset($receipt) && $receipt)
                        @foreach ($receipt as $value)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $value->date }}</td>
                                <td>{{ "Receipt No.:".$value->id.", Receipt Mode : ".$value->payment_mode }}</td>
                                <td>0</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{ $totalAmount - $value->amount  }}</td>
                            </tr>
                        @endforeach
                    @endif
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
        $('#amc').val([]);
    }
    else
    {
        $('#party_div').hide();
        $('#amc_div').show();
        $('#party').val([]);
    }
});
</script>
@endsection
