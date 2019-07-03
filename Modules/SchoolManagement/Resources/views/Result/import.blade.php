@extends('layouts.backend.containerlist')
@section('dynamicdata')
@include('layouts.backend.alert')
<form action="{{ route('admin.school-management.result.import.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    Choose your xls/csv File : <input type="file" name="file" class="form-control">
 	<br/>
    <input type="submit" class="btn bg-light-blue waves-effect" value="Submit">
</form>
@stop