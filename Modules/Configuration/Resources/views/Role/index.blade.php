@extends('layouts.backend.containerlist') 

@section('footer_js')
<script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
@endsection

@section('dynamicdata')

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">ROLES</h3>
        <ul class="header-dropdown m-r--5 pull-right">
            <li class="dropdown" style="list-style : none;">
               <a href="{{ route('admin.privilege.role.create') }}"><button type="button" class="btn btn-primary waves-effect">ADD NEW <b>+</b></button></a>
            </li>
        </ul>
      </div>

      <!-- /.box-header -->
      <div class="box-body">
      
      @include('layouts.backend.alert')

        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>SN</th>
              <th>RoleName</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
   
          @foreach($roles as $index=>$role)
              <tr class="gradeX" id="row_{{ $role->id }}">
                <td class="index">
                      {{ ++$index }}
              </td>
              <td class="name">
                    {{ $role->role }}
              </td>
              <td>
                <a class="edit-role" href="{{ route('admin.privilege.role.edit', $role->id) }}" id="{{ $role->id }}" title="Edit Role">
                  &nbsp;<i class="fa fa-pencil"></i>
                </a>&nbsp;
              </td>
              </tr>
          @endforeach

            <tfoot>
              <tr>
                <th>SN</th>
                <th>RoleName</th>
                <th>Option</th>
              </tr>
            </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @stop
