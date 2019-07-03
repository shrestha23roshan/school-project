@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#facultyEditForm').formValidation({
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
                                    message: 'Name field is required.'
                                }
                            }
                        },
                        designation: {
                            validators: {
                                notEmpty: {
                                    message: 'Designation field is required.'
                                }
                            }
                        },
                        department: {
                            validators: {
                                notEmpty: {
                                    message: 'Department field is required.'
                                }
                            }
                        },
                        type: {
                            validators: {
                                notEmpty: {
                                    message: 'Type field is required.'
                                }
                            }
                        },
               
                        attachment: {
                            validators: {
                                file: {
                                    extension: 'jpg,jpeg,png',
                                    maxSize: 1048576,   // 1 * 1024 * 1024
                                    message: 'The selected file is not valid or file size greater than 1 MB.'
                                }
                            }
                        },
                }
        }).on('blur', '[name="full_name"]', function(e){
            $('#facultyEditForm').formValidation('revalidateField', 'full_name');
            $('#facultyEditForm').formValidation('revalidateField', 'designation');
            $('#facultyEditForm').formValidation('revalidateField', 'department');
            $('#facultyEditForm').formValidation('revalidateField', 'type');
        })
    });
</script>

<script>
    $("#file-upload").change(function(){
        $("#file-name").text(this.files[0].name);
    });
</script>
@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
            <h3 class="box-title">Edit Faculty</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="facultyEditForm" method="POST" action="{{ route('admin.content-management.faculty.update', $faculty->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter full name." value="{{ $faculty->full_name }}" >
            </div>

            <div class="form-group">
                <label for="designation">Designation *</label>
                <input type="text" name="designation" class="form-control" id="designation" placeholder="Enter designation." value="{{ $faculty->designation }}" >
            </div>

            <div class="form-group">
                <label for="department">Department *</label>
                <input type="text" name="department" class="form-control" id="department" placeholder="Enter department." value="{{ $faculty->department }}" >
            </div>

            <div class="form-group">
                <label for="type">Type *</label>
                <select name="type" class="form-control">
                    <option value="0" {!! ($faculty->type == '0') ? 'selected="selected"' : '' !!}>PRE-PRIMARY</option>
                    <option value="1" {!! ($faculty->type == '1') ? 'selected="selected"' : '' !!}>BASIC</option>
                    <option value="2" {!! ($faculty->type == '2') ? 'selected="selected"' : '' !!}>SECONDARY</option>
                    <option value="3" {!! ($faculty->type == '3') ? 'selected="selected"' : '' !!}>HIGHER SECONDARY</option>
                    {{-- <option value="4" {!! ($faculty->type == '4') ? 'selected="selected"' : '' !!}>NON-TEACHING</option> --}}
                </select>
            </div>
        
            <div class="form-group">
                <label for="attachment">File Attachment *</label>

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" >
                        @if(file_exists('uploads/content-management/faculty/'.$faculty->attachment) && $faculty->attachment != '')
                            <img src="{{ asset('uploads/content-management/faculty/'.$faculty->attachment) }}" alt="{{ $faculty->name }}">
                        @else
                            <img src="{{ asset('uploads/content-management/faculty/default-img.jpg') }}" alt="default-image">
                        @endif
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 600px; max-height: auto; line-height: 20px;">
                    </div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-undo"></i> Change File</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change File</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
            </div>
    
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="is_active">
                <option value="1" {{ ($faculty->is_active == 1) ? 'selected=selected' : '' }}>Active</option>
                <option value="0" {{ ($faculty->is_active == 0) ? 'selected=selected' : '' }}>Inactive</option>
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