@extends('layouts.backend.containerlist')

@section('dynamicdata')
@section('header_css')
    <style>
        .bg-pink{
            background: #E91E63 ;
            color: white;
        }
    </style>
@endsection
<div class="box">
    <div class="box-header with-border">
        <a href="{{ route('admin.school-management.result.create') }}"><button class="btn btn-primary">Add New &nbsp;<i class="fa fa-plus"></i></button></a>
        <a href="{{ route('admin.school-management.result.import.index') }}"><button class="btn btn-warning waves-effect">IMPORT FROM EXCEL &nbsp;<i class="fa fa-plus"></i></button></a>
        {{-- <a href="{{ route('admin.school-management.result.import.index') }}"><button type="button" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#addNewUserModal">IMPORT FROM EXCEL<b> + </b></button></a> --}}

        <a><button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#publish_result" >PUBLISH RESULT</button></a>
        <a><button type="button" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#unpublish_result" >UNPUBLISH RESULT</button></a>
        <a><button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#custom-width-modal" >DELETE ALL</button></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="example1" class="table table-bordered table-striped result-table">
        <thead>
            <tr>
                <th>SN</th>
                <th>Registration No</th>
                <th>Full Name</th>
                <th>Class</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
       
        <tbody id="tablebody">
                @foreach($results as $index => $record)
        
                <tr>
                    <td> {{ $index +1 }}</td>
                    <td> {{ $record->registration_no }} </td>
                    <td> {{ $record->full_name }} </td>
                    <td> {{ $record->class }} </td>
                    <td> {{ $record->remark }} </td>
                    <td>
                        @if($record->is_active == '1')
                        <small class="label bg-green">Active</small>
                        @else
                        <small class="label bg-red">Inactive</small>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.school-management.result.edit', $record->id) }}" title="Edit Result"><button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button></a>&nbsp;
                        <a href="javascript:;" title="Delete result" class="delete-result" id="{{ $record->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                    </td>
                </tr>
    
            @endforeach
        </tbody>
        <tfoot>
        <tr>
                <th>SN</th>
                <th>Registration No</th>
                <th>Full Name</th>
                <th>Class</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Options</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
   <!-- Modal -->
   <div class="modal fade" id="custom-width-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-red">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Are you sure to delete all record?</h4>
                </div>
                <div class="modal-footer">
                    <a href="{!! route('admin.school-management.result.deleteall') !!}"><button type="button" class="btn btn-link waves-effect">DELETE</button></a>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Publish Result Modal -->
     <div class="modal fade" id="publish_result" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-red">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Are you sure to publish result?</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a href="{!! route('admin.school-management.result.publish') !!}"><button type="button" class="btn btn-link waves-effect">PUBLISH</button></a>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Unpublish Result Modal -->
     <div class="modal fade" id="unpublish_result" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-red">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Are you sure to unpublish result?</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a href="{!! route('admin.school-management.result.unpublish') !!}"><button type="button" class="btn btn-link waves-effect">UNPUBLISH</button></a>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>


  <!-- /.box -->
@endsection

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('.result-table').dataTable();

        $('#tablebody').on('click', '.delete-result', function(e){
        e.preventDefault();
        $object = $(this);
        var id = $object.attr('id');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            $.ajax({
                type: "DELETE",
                url: "{{ url('/admin/school-management/result') }}"+"/"+id,
                dataType: 'json',
                success: function(response){
                    var nRow = $($object).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                    swal('success', response.message, 'success').catch(swal.noop);
                },
                error: function(e){
                    swal('Oops...', 'Something went wrong!', 'error').catch(swal.noop);
                }
            });
        }).catch(swal.noop);
        });
    });
</script>
@endsection
