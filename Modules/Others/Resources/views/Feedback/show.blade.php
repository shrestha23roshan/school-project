@extends('layouts.backend.containerform')

@section('footer_js')
    <script text="text/javascript">
        $("#message").height($("textarea")[0].scrollHeight);
    </script>
@endsection

@section('dynamicdata')

<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Feedback Detail</h3>
    </div>
    <!-- /.box-header -->

    <div class="box-body">

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $feedback->full_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="{{ $feedback->email }}" disabled>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="text" name="date" class="form-control" value="{{ $feedback->created_at }}" disabled>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" disabled>{{ strip_tags($feedback->message) }}</textarea>
        </div>

    </div>
    <!-- /.box-body -->

</div>

@endsection