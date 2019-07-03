@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#resultAddForm').formValidation({
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
                registration_no: {
                        validators: {
                            notEmpty: {
                                message: 'Registration Number field is required.'
                            },
                        }
                    },
                class: {
                    validators: {
                        notEmpty: {
                            message: 'Class field is required.'
                        },
                    }
                }, 
                remark: {
                        validators: {
                            notEmpty: {
                                message: 'Remark field is required.'
                            },
                        }
                    },  
            }
        }).on('blur', '[name="full_name"]', function(e){
            $('#resultAddForm').formValidation('revalidateField', 'full_name');
            $('#resultAddForm').formValidation('revalidateField', 'registration_no');
            $('#resultAddForm').formValidation('revalidateField', 'class');
            $('#resultAddForm').formValidation('revalidateField', 'remark');
        })
    });
</script>

@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Result</h3>
</div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="resultAddForm" method="POST" action="{{ route('admin.school-management.result.store') }}">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter full name." value="{{ old('full_name') }}" >
            </div>
           
            <div class="form-group">
                <label for="registration_no">Registration Number *</label>
                <input type="text" name="registration_no" class="form-control" id="registration_no" placeholder="Enter registration num." value="{{ old('registration_no') }}" >
            </div>

            <div class="form-group">
                <label for="class">Class *</label>
                <input type="text" name="class" class="form-control" id="class" placeholder="Enter class." value="{{ old('class') }}" >
            </div>

            <div class="form-group">
                <label for="remark">Remark *</label>
                <input type="text" name="remark" class="form-control" id="remark" placeholder="Enter Remark." value="{{ old('remark') }}" >
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