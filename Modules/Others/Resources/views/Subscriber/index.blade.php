@extends('layouts.backend.containerlist')

@section('dynamicdata')
<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      @include('layouts.backend.alert')
      <table id="example1" class="table table-bordered table-striped subscribers-table">
        <thead>
        <tr>
            <th>SN</th>
            <th>Email</th>
            <th>Subscribed Date</th>
        </tr>
        </thead>
        <tbody id="tablebody">
            @foreach($subscribers as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->email }}</td>
                    <td>{{ $record->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>SN</th>
            <th>Email</th>
            <th>Subscribed Date</th>
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

      var oTable = $('.subscribers-table').dataTable();

  });
</script>
@endsection
