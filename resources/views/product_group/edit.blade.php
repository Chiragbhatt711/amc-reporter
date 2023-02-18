@extends('layouts.adminapp')

@section('content')
@if (count($errors) > 0)

@endif
{!! Form::model($group, ['method' => 'PATCH','route' => ['product_group.update', $group->id]]) !!}
@csrf
<div class="container">
    <div id="accordion">
        <div class="row mt-1">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <strong class="lab_space">Group <em class="text-danger">*</em></strong>
                    {!! Form::text('group', null, array('placeholder' => 'Group' ,'class' => 'form-control')) !!}
                    @error('group')
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
