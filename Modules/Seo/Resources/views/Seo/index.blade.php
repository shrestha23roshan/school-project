@extends('layouts.backend.containerlist')

@section('dynamicdata')
<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="example1" class="table table-bordered table-striped seos-table">
        <thead>
        <tr>
            <th>SN</th>
            <th>Page</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody id="tablebody">
            @foreach($seos as $index => $record)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $record->page }}</td>
              <td>
                <a href="{{ route('admin.seo.edit', $record->id) }}" title="Edit Seo"><button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button></a>&nbsp;
              </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Page</th>
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

      var oTable = $('.seos-table').dataTable();

  });
</script>
@endsection
