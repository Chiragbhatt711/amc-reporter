@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Manage AMC</h3>
    </div>
    <table class="table dynamic-data-table">
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
function deleteFunction(id){
    $('#deleteForm').attr('action','{{ url("manage_amc") }}'+ '/'+id);
    $('#deleteModal').modal('show');
}
</script>
@endsection
