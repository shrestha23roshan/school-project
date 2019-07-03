@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#facultyAddForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                full_name: {
                    validators: {
                        notEmpty: {
                            message: 'Full Name field is required.'
                        }
                    }
                },
                designation: {
                    validators: {
                        notEmpty: {
                            message: 'Designation field is required.'
                        },
                    }
                },
                department: {
                    validators: {
                        notEmpty: {
                            message: 'Department field is required.'
                        },
                    }
                },
                type	: {
                    validators: {
                        notEmpty: {
                            message: 'Type field is required.'
                        },
                    }
                },
                attachment: {
                    validators: {
                        notEmpty: {
                            message: 'Attachment field is required.'
                        },
                        file: {
                            extension: 'jpg,jpeg,png',
                            maxSize: 1048576,   // 1 * 1024 * 1024
                            message: 'The selected file is not valid or file size greater than 1 MB.'
                        }
                    }
                },
            }
        }).on('blur', '[name="full_name"]', function(e){
            $('#facultyAddForm').formValidation('revalidateField', 'full_name');
            $('#facultyAddForm').formValidation('revalidateField', 'designation');
            $('#facultyAddForm').formValidation('revalidateField', 'department');
            $('#facultyAddForm').formValidation('revalidateField', 'type');
        })
    });
</script>

@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Faculty</h3>
</div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="facultyAddForm" method="POST" action="{{ route('admin.content-management.faculty.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter full name." value="{{ old('full_name') }}" >
            </div>
           
            <div class="form-group">
                <label for="designation">Designation *</label>
                <input type="text" name="designation" class="form-control" id="designation" placeholder="Enter designation." value="{{ old('designation') }}" >
            </div>

            <div class="form-group">
                <label for="department">Department *</label>
                <input type="text" name="department" class="form-control" id="department" placeholder="Enter department." value="{{ old('department') }}" >
            </div>

            <div class="form-group">
                
                <label for="type">Type*</label>
                <select name="type" class="form-control">
                    <option value="0">PRE-PRIMARY</option>
                    <option value="1">BASIC</option>
                    <option value="2">SECONDARY</option>
                    <option value="3">HIGHER SECONDARY</option>
                    {{-- <option value="4">NON-TEACHING</option> --}}
                </select>
                
            </div>

            <div class="form-group">
                <label for="attachment">Photo Attachment *</label>
    
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 600px; height: auto;">
                        <img src="{{ asset('uploads/content-management/faculty/default-img.jpg') }}" alt="">
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 600px; max-height: auto; line-height: 20px;">
                    </div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-file-pencil"></i> Select photo</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change photo</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
                <span>Photo file format should be in jpg, jpeg and png.</span>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="is_active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
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