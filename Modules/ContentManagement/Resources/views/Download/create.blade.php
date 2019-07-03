@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#downloadAddForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                    heading: {
                        validators: {
                            notEmpty: {
                                message: 'Heading field is required.'
                            }
                        }
                    },
                    attachment: {
                        validators: {
                            notEmpty: {
                                message: 'Attachment field is required.'
                            },
                            file: {
                                extension: 'jpg,jpeg,png,pdf,doc',
                                maxSize: 1048576,   // 1 * 1024 * 1024
                                message: 'The selected file is not valid or file size greater than 1 MB.'
                            }
                        }
                    },
                
            }
        }).on('blur', '[name="heading"]', function(e){
            $('#downloadAddForm').formValidation('revalidateField', 'heading');
            
        })
    });
</script>

@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Download</h3>
</div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="downloadAddForm" method="POST" action="{{ route('admin.content-management.download.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="heading">Heading *</label>
                <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading." value="{{ old('heading') }}" >
            </div>
          
            <div class="form-group">
                <label for="attachment">File Attachment *</label>
    
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-file-pencil"></i> Select File</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change File</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
                <span>file format should be in jpg, jpeg, doc, pdf and png.</span>
            </div>
          
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="is_active">
                <option value="1">Published</option>
                <option value="0">Unpublished</option>
                </select>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection