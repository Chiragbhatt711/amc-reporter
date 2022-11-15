@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::open(array('route' => 'manage_party.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">party name  <em class="text-danger">*</em></strong>
                    <div class="d-flex">
                    {!! Form::select('party_id', $partyName , null, ['class' => 'form-select','placeholder' =>'Please Select', 'id'=>'product_id' ]) !!}
                </div>
                    @error('party_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn_tile">Submit</button>
            </div>
        </div>
    </div>
</div>
  {!! Form::close() !!}
@endsection

@section('js-script')
<script>

</script>
@endsection
