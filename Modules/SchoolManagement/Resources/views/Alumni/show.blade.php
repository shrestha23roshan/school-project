@extends('layouts.backend.containerform')

@section('footer_js')
   
@endsection

@section('dynamicdata')

<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Alumni Detail</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <p><label>Name: </label> {{ $alumni->full_name }}</p>
        <p><label>Batch:</label> {{ $alumni->batch }}</p>
        <p><label>Email:</label> {{ $alumni->email }}</p>
        <p><label>Phone No:</label> {{ $alumni->phone_no }}</p>
        <p><label>Address:</label> {{ $alumni->address }}</p>
        <p><label>Occupation:</label> {{ $alumni->occupation }}</p>
        <p><label>Message: </label> {{ $alumni->message }}</p>
    </div>
    
    <!-- /.box-body -->

</div>

@endsection