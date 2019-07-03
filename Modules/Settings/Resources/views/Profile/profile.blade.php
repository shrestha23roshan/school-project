@extends('layouts.backend.containerform') 

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {

        $('#profileUpdateForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                image_icon: {
                    validators: {
                        notEmpty: {
                            message: 'Profile Picture field is required.'
                        }
                    }
                },
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Username field is required.'
                        }
                    }
                },
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
                        }
                    }
                },
            }
        });

        $('#passwordUpdateForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: 'New Password field is required.'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'Confirm Password field is required.'
                        }
                    }
                },
            }
        });
    });
</script>
@endsection 

@section('dynamicdata')

<!-- iCheck -->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Profile</h3>
    </div>

    <div class="box-body">

        @include('layouts.backend.alert')

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#account" data-toggle="tab">
                    <i class="fa fa-user-circle"></i> ACCOUNT
                </a>
            </li>
            <li role="presentation">
                <a href="#password" data-toggle="tab">
                    <i class="fa fa-key"></i> PASSWORD
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="account">
                <br/>

                <form id="profileUpdateForm" action="{{ route('admin.settings.profile.update') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="control-label">Profile Photo *</label>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 80px; height: auto;">
                                @if(Auth::user()->image_icon)
                                    <img src="{{ URL::asset('uploads/settings/profile/'.Auth::user()->image_icon.'-s.jpg') }}" width="80" alt="person"> 
                                @else
                                    <img src="{{ URL::asset('uploads/noimage.jpg') }}" alt="person" width="80" /> 
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" 
                                style="max-width: 80px; max-height: 80px; line-height: 20px;">
                            </div>
                            <div>
                                <span class="btn btn-primary btn-file">
                                    <span class="fileupload-new">
                                        <i class="fa fa-undo"></i> Change photo</span>
                                    <span class="fileupload-exists">
                                        <i class="fa fa-undo"></i> Change photo</span>
                                    <input type="file" name="image_icon" class="default" />
                                </span>
                            </div>
                        </div>
                        <span class="badge bg-red">NOTE!</span>
                        <br/>
                        <span>size 80*80px</span>
                        <br/>
                        <span>photo file format should be in jpg, jpeg and png.</span>

                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="control-label">Username *</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Enter Username." value="{{ Auth::user()->username }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Full Name *</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="full_name" placeholder="Enter Full Name." value="{{ Auth::user()->full_name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Designation *</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="designation" placeholder="Enter Designation." value="{{ Auth::user()->designation }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            
            <div role="tabpanel" class="tab-pane fade" id="password">
                <br/>

                <form id="passwordUpdateForm" method="post" action="{{ route('admin.settings.profile.password.update') }}" name="pass_form"
                    role="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="control-label">New Password *</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Enter new password.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Confirm Password *</label>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm password.">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- #END# Basic Table -->

        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col (right) -->
</div>
<!-- /.row -->
@stop
