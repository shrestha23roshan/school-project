@extends('layouts.backend.containerform') 

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {

        $('#settingEditForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                site_name: {
                    validators: {
                        notEmpty: {
                            message: 'Site Name field is required.'
                        }
                    }
                },
                site_email: {
                    validators: {
                        notEmpty: {
                            message: 'Site Email field is required.'
                        }
                    }
                },
                site_description: {
                    validators: {
                        notEmpty: {
                            message: 'Site Description field is required.'
                        }
                    }
                },
                site_address: {
                    validators: {
                        notEmpty: {
                            message: 'Site Address field is required.'
                        }
                    }
                },
                site_phone: {
                    validators: {
                        notEmpty: {
                            message: 'Site Phone no. field is required.'
                        }
                    }
                },
                facebook_url: {
                    validators: {
                        notEmpty: {
                            message: 'Facebook Url field is required.'
                        }
                    }
                },
                twitter_url: {
                    validators: {
                        notEmpty: {
                            message: 'Twitter Url field is required.'
                        }
                    }
                },
                google_plus_url: {
                    validators: {
                        notEmpty: {
                            message: 'Google Plus Url field is required.'
                        }
                    }
                },
                youtube_url: {
                    validators: {
                        notEmpty: {
                            message: 'Youtube Url field is required.'
                        }
                    }
                },
                site_copyright: {
                    validators: {
                        notEmpty: {
                            message: 'Site Copyright field is required.'
                        }
                    }
                },
            }
        });
    });
</script>
@endsection

@section('dynamicdata')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Settings</h3>
    </div>

    <div class="box-body">

        @include('layouts.backend.alert')

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#school_project" data-toggle="tab">
                    <i class="fa fa-university"></i> General
                </a>
            </li>
            <li role="presentation">
                <a href="#social_media" data-toggle="tab">
                    <i class="fa fa-link"></i> Social media
                </a>
            </li>
            <li role="presentation">
                <a href="#others1" data-toggle="tab">
                    <i class="fa fa-list"></i> Other
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <form id="settingEditForm" action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="school_project">
                    <br/>
                    <div class="form-group">
                        <label class="control-label">Name *</label>
                        <input type="text" class="form-control" name="site_name" placeholder="Site Name" value="{{ $setting->site_name }}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Email *</label>
                        <input type="text" class="form-control" name="site_email" placeholder="info@sitename.com" value="{{ $setting->site_email }}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Description *</label>
                        <textarea type="text" class="form-control" name="site_description" placeholder="Site Description">{{ $setting->site_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Address *</label>
                        <input type="text" class="form-control" name="site_address" placeholder="Site Address" value="{{ $setting->site_address }}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Phone number *</label>
                        <input type="text" class="form-control" name="site_phone" placeholder="Site Phone no." value="{{ $setting->site_phone }}">
                    </div>

                </div>

                <div role="tabpanel" class="tab-pane fade" id="social_media">
                    <br/>

                    <div class="form-group">
                        <label class="control-label">Facebook Url</label>
                        <input type="text" class="form-control" name="facebook_url" placeholder="Enter Facebook Url" value="{!! $setting->facebook_url !!}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Twitter Url</label>
                        <input type="text" class="form-control" name="twitter_url" placeholder="Enter Twitter Url" value="{!! $setting->twitter_url !!}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Google Plus Url</label>
                        <input type="text" class="form-control" name="google_plus_url" placeholder="Enter Google Plus Url" value="{!! $setting->google_plus_url !!}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Youtube Url</label>
                        <input type="text" class="form-control" name="youtube_url" placeholder="Enter Youtube Url" value="{!! $setting->youtube_url !!}">
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="others1">
                    <br/>

                    <div class="form-group">
                            <label class="control-label">Site Logo</label>
    
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 150px; height: 200px;">
                                    @if(file_exists('uploads/settings/'.$setting->site_logo) && $setting->site_logo != '')
                                        <img src="{{ asset('uploads/settings/'.$setting->site_logo) }}" alt="logo"> 
                                    @else
                                        <img src="{{ asset('uploads/settings/logo.png') }}" alt="logo"> 
                                    @endif
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 270px; max-height: 387px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileupload-new">
                                            <i class="fa fa-undo"></i> Change photo</span>
                                        <span class="fileupload-exists">
                                            <i class="fa fa-undo"></i> Change photo</span>
                                        <input type="file" name="site_logo" class="default" / value="{{ $setting->site_logo }}">
                                    </span>
                                </div>
                            </div>
                            <span class="badge bg-red">NOTE!</span>
                            <br/>
                            <span>size 244*122px</span>
                            <br/>
                            <span>photo file format should be in jpg, jpeg and png.</span>
    
                        </div>
                        <div class="clearfix"></div>
    
                        <div class="form-group">
                            <label class="control-label">Site Favicon</label>
    
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 32px; height: 32px;">
                                    @if(file_exists('uploads/settings/'.$setting->site_favicon) && $setting->site_favicon != '')
                                        <img src="{{ asset('uploads/settings/'.$setting->site_favicon) }}" alt="favicon"> 
                                    @else
                                        <img src="{{ asset('uploads/settings/favicon.png') }}" alt=""> 
                                    @endif
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 180px; max-height: 49px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileupload-new">
                                            <i class="fa fa-undo"></i> Change photo</span>
                                        <span class="fileupload-exists">
                                            <i class="fa fa-undo"></i> Change photo</span>
                                        <input type="file" name="site_favicon" class="default" />
                                    </span>
                                </div>
                            </div>
                            <span class="badge bg-red">NOTE!</span>
                            <br/>
                            <span>Size 16*16px</span>
                            <br/>
                            <span>photo file format should be in jpg, jpeg and png.</span>
    
                        </div>
                        <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="control-label">Site Copyright</label>
                        <input type="text" class="form-control" name="site_copyright" placeholder="Copyright:Date SiteName.com" value="{{ $setting->site_copyright }}">
                    </div>

                </div>

            </div>

                <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        </div>

    </div>
    
@stop
