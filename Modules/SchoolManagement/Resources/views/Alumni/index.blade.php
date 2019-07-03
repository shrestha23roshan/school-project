@extends('layouts.backend.containerlist')

@section('dynamicdata')
<div class="box">
    <div class="box-header with-border">
        <h2> Alumni </h2>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="example1" class="table table-bordered table-striped alumni-table">
        <thead>
        <tr>
            <th>SN</th>
            <th>Full Name</th>
            <th>Batch</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        </thead>
       
        <tbody id="tablebody">
           @foreach($alumnis as $index => $record)
            <tr>
                <td> {{ $index + 1}} </td>
                <td> {{ $record->full_name}}</td>
                <td> {{ $record->batch }}</td>
                <td>
                    @if($record->is_active == '1')
                    <small class="label bg-green">Active</small>
                    @else
                    <small class="label bg-red">Inactive</small>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.school-management.alumni.show', $record->id) }}" title="View Alumni"><button class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></button></a>&nbsp;
                    <a href="javascript:;" title="Delete alumni" class="delete-alumni" id="{{ $record->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                </td>
            </tr>
           @endforeach
         </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Full Name</th>
            <th>Batch</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('.alumni-table').dataTable();

        $('#tablebody').on('click', '.delete-alumni', function(e){
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
                url: "{{ url('/admin/school-management/alumni') }}"+"/"+id,
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
