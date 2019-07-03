@extends('layouts.backend.containerform')

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#noticeEditForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    subject: {
                        validators: {
                            notEmpty: {
                                message: 'Subject field is required.'
                            }
                        }
                    },
                    date: {
                    validators: {
                        notEmpty: {
                            message: 'Date field is required.'
                        },
                    }
                },
                description: {
                        validators: {
                            notEmpty: {
                                message: 'Description field is required.'
                            },
                        }
                    }
                }
            }).on('blur', '[name="subject"]', function(e){
                $('#noticeAddForm').formValidation('revalidateField', 'subject');
                $('#noticeAddForm').formValidation('revalidateField', 'description');

                
            }).find('[name="description"]')
                .each(function () {
                    $(this)
                        .ckeditor({
                            allowedContent: true
                        })
                        .editor
                        .on('change', function (e) {
                            $('#serviceEditForm').formValidation('revalidateField', e.sender.name);
                        });
                });
        });
    </script>
@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form id="noticeEditForm" method="POST" action="{{ route('admin.content-management.notice.update', $notice->id) }}">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

        <div class="form-group">
            <label for="subject">Subject *</label>
        <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter subject." value="{{ $notice->subject}}">
            
        </div>

        <div class="form-group">
            <div class="form-group has-feedback">
                <label for="date">Date *</label>
            <input type="text" class="form-control" name="date" id="datepicker" placeholder="Select date." value="{{ $notice->date}}">
                <span class="fa fa-calendar form-control-feedback"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description *</label>
            <textarea class="form-control" name="description">{!! $notice->description !!}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="is_active">
            <option value="1" {{ ($notice->is_active == "1") ? 'selected=selected' : '' }}>Published</option>
            <option value="0" {{ ($notice->is_active == "0") ? 'selected=selected' : '' }}>Unpublished</option>
            </select>
        </div>

        </div>
       
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <input type="hidden" name="_method" value="PUT">
    </form>
</div>

@endsection