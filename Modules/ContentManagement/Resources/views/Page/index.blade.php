@extends('layouts.backend.containerlist')

@section('dynamicdata')
<div class="box">
    <div class="header">
        <h2>MAIN PAGES</h2>
    </div>
    <div class="box-header with-border">
      <a href="{{ route('admin.content-management.page.create') }}"><button class="btn btn-primary">Add New &nbsp;<i class="fa fa-plus"></i></button></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="page-table1" class="table table-bordered table-striped ">
        <thead>
        <tr>
            <th>SN</th>
            <th>Heading</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        </thead>
       
        <tbody id="tablebody1">
                @foreach($parentpages as $index=>$record)
                <tr>
                    <td>
                        {{ $index+1 }}
                    </td>
                    <td class="heading">
                        {{ $record->heading }}
                    </td>
                    <td>
                        @if($record->is_active == '1')
                        <small class="label bg-green">Active</small>
                        @else
                        <small class="label bg-red">Inactive</small>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.content-management.page.edit', $record->id) }}" title="Edit page"><button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button></a>&nbsp;
                        <a href="javascript:;" title="Delete page" class="delete-page" id="{{ $record->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                    </td>
                </tr>
                @endforeach
         </tbody>

        <tfoot>
        <tr>
            <th>SN</th>
            <th>Heading</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>

  <div class="box">
        <div class="header">
            <h2>SUB PAGES</h2>
        </div>
        <div class="box-header with-border">
          <a href="{{ route('admin.content-management.page.create') }}"><button class="btn btn-primary">Add New &nbsp;<i class="fa fa-plus"></i></button></a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @include('layouts.backend.alert')
          <table id="page-table2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>SN</th>
                <th>Heading</th>
                <th>Main Page</th>
                <th>Order</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
            </thead>
           
            <tbody id="tablebody2">
                    @foreach($childpages as $index=>$record)
                    <tr>
                        <td>
                            {{ $index+1 }}
                        </td>
                        <td class="heading">
                            {{ $record->heading }}
                        </td>
                        <td class="parent">
                            {{ $record->parent ? $record->parent->heading : '' }}
                        </td>
                        <td>
                            <span class="badge bg-teal"> {{ $record->order_position }}</span>
                        </td>
                        <td>
                            @if($record->is_active == '1')
                            <small class="label bg-green">Active</small>
                            @else
                            <small class="label bg-red">Inactive</small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.content-management.page.edit', $record->id) }}" title="Edit page"><button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button></a>&nbsp;
                            <a href="javascript:;" title="Delete page" class="delete-page" id="{{ $record->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
             </tbody>
    
            <tfoot>
            <tr>
                <th>SN</th>
                <th>Heading</th>
                <th>Main Page</th>
                <th>Order</th>
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
        var oTable1 = $('#page-table1').dataTable();

        var oTable2 = $('#page-table2').dataTable();

          $('#tablebody1').on('click', '.delete-page', function(e){
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
                url: "{{ url('/admin/content-management/page') }}"+"/"+id,
                dataType: 'json',
                success: function(response){
                    var nRow = $($object).parents('tr')[0];
                    oTable1.fnDeleteRow(nRow);
                    swal('success', response.message, 'success').catch(swal.noop);
                },
                error: function(e){
                    swal('Oops...', 'Something went wrong!', 'error').catch(swal.noop);
                }
            });
        }).catch(swal.noop);
        });

//////////////////////////////////
           $('#tablebody2').on('click', '.delete-page', function(e){
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
                url: "{{ url('/admin/content-management/page') }}"+"/"+id,
                dataType: 'json',
                success: function(response){
                    var nRow = $($object).parents('tr')[0];
                    oTable2.fnDeleteRow(nRow);
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
