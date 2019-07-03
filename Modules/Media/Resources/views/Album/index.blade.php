@extends('layouts.backend.containerlist')

@section('dynamicdata')
<div class="box">
    <div class="box-header with-border">
      <a href="{{ route('admin.media.album.create') }}"><button class="btn btn-primary">Add New &nbsp;<i class="fa fa-plus"></i></button></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="example1" class="table table-bordered table-striped albums-table">
        <thead>
        <tr>
          <th>SN</th>
          <th>Name</th>
          <th>Cover image</th>
          <th>Status</th>
          <th>Options</th>
          <th>Others</th>
        </tr>
        </thead>
        <tbody id="tablebody">
        @foreach($albums as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->name }}</td>
                <td class="image">
                    @if($record->attachment)
                        <img src="{{ asset('uploads/media/album/' . $record->attachment) }}" alt="{{ $record->name }}" width="200">
                    @endif
                </td>
                <td>
                    @if($record->is_active == '1')
                    <small class="label bg-green">Active</small>
                    @else
                    <small class="label bg-red">Inactive</small>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.media.album.edit', $record->id) }}" title="Edit album"><button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button></a>&nbsp;
                    <a href="javascript:;" title="Delete album" class="delete-album" id="{{ $record->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                </td>
                <td>
                    <a href="{!! route('admin.media.album.photo.index', $record->id) !!}" title="View Photos" ><button type="button" class="btn bg-purple btn-circle waves-effect waves-circle waves-float"><i class="fa fa-eye"></i></button></a>&nbsp;
                    <a href="{!! route('admin.media.album.photo.create', $record->id) !!}" title="Add Photo" ><button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float"><i class="fa fa-camera-retro"></i></button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Cover image</th>
            <th>Status</th>
            <th>Options</th>
            <th>Others</th>
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
        var oTable = $('.albums-table').dataTable();

        $('#tablebody').on('click', '.delete-album', function(e){
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
                url: "{{ url('/admin/media/album') }}"+"/"+id,
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
