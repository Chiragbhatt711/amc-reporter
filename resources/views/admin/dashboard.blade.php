@extends('layouts.adminapp')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert_msg">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="title">
        <h3>Dashboard</h3>

    </div>
</div>
@endsection

@section('js-script')
<script>

</script>
@endsection
