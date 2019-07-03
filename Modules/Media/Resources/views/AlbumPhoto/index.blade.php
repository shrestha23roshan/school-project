@extends('layouts.backend.containerlist')

@section('dynamicdata')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">  ALBUM : {{ $album->name }} </h3>
        <ul class="header-dropdown m-r--5 pull-right">
            <ul class="header-dropdown m-r--5">
                <li class="dropdown" style="list-style: none;">
                    <a href="{{ route('admin.media.album.photo.create', $album->id) }}"><button class="btn btn-primary">Add New &nbsp;<i class="fa fa-plus"></i></button></a>
                </li>
            </ul>
        </ul>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="example1" class="table table-bordered table-striped photos-table">
        <thead>
        <tr>
          <th>SN</th>
          <th>Photo</th>
          <th>Options</th>
        </tr>
        </thead>
        <tbody id="tablebody">
        @foreach($photos as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="image">
                    @if($record->attachment)
                        <img src="{{ asset('uploads/media/album/photos/' . $record->attachment) }}" alt="{{ $record->name }}" width="200">
                    @endif
                </td>
                <td>
                    <a href="javascript:;" title="Delete photo" class="delete-photo" id="{{ $record->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Photo</th>
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
        var oTable = $('.photos-table').dataTable();

        $('#tablebody').on('click', '.delete-photo', function(e){
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
                url: "{{ url('/admin/media/album/photo') }}"+"/"+id,
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
