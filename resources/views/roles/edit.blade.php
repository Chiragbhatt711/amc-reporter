@extends('layouts.adminapp')
@section('content')

<div class="container">
    <div class="row">
        <!-- trading history area start -->
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="form_sub_title text-center border-0">Create role</h4>
                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text( 'name', null, array('placeholder' =>'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <br/>
                                        @if($permissions)
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                    <strong>Menu</strong>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                                    <strong>Permissions</strong>
                                                </div>
                                            </div>
                                            <hr/>
                                            @foreach ($permissions as $key => $permission)
                                            <div class="row">
                                                @php
                                                    $mainTitle = "";
                                                    $menuName = $key;

                                                    if(trim(strtolower($key)) == 'role')
                                                    {
                                                        $menuName = 'role';
                                                        $mainTitle = "Role";
                                                    }
                                                    if(trim(strtolower($key)) == 'user')
                                                    {
                                                        $menuName = 'user';
                                                        $mainTitle = "User profile";
                                                    }
                                                    if(trim(strtolower($key)) == 'contract-type')
                                                    {
                                                        $menuName = 'contract-type';
                                                        $mainTitle = "Contract type";
                                                    }
                                                @endphp
                                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                    <strong style="margin-right: 80px;">{{ $mainTitle }}</strong>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                                    <div class="d-flex flex-row checkboxes">
                                                        @foreach ($permission as $val)
                                                        <div class="check d-flex flex-row align-items-center gap-2">
                                                            {{ Form::checkbox('permission[]', $val->id, in_array($val->id, $rolePermissions) ? true : false, ['class' => 'name','onclick'=>'permissionListAutoSelect(this)','data-id'=> $val->id,'data-name'=>$val->name,'data-menu-name'=>$menuName,'id'=>$val->name]) }}
                                                            {{$val->view_name}}
                                                            <label data-type="{{$val->name}}">
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
        <!-- trading history area end -->
    </div>
</div>

@endsection
