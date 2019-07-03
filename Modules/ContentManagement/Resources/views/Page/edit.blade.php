@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#pageEditForm').formValidation({
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
                description: {
                        validators: {
                            notEmpty: {
                                message: 'Description field is required.'
                            },
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
                    breadcrumb_attachment: {
                        validators: {
                            file: {
                                extension: 'jpg,jpeg,png',
                                maxSize: 1048576,   // 1 * 1024 * 1024
                                message: 'The selected file is not valid or file size greater than 1 MB.'
                            }
                        }
                    },
                    meta_title: {
                    validators: {
                        notEmpty: {
                            message: 'Meta Title field is required.'
                        }
                    }
                },
                meta_tags: {
                    validators: {
                        notEmpty: {
                            message: 'Meta Keywords field is required.'
                        }
                    }
                },
                meta_description: {
                    validators: {
                        notEmpty: {
                            message: 'Meta Description field is required.'
                        }
                    }
                }
                
            }
        }).on('blur', '[name="heading"]', function(e){
            $('#pageEditForm').formValidation('revalidateField', 'heading');
            $('#pageEditForm').formValidation('revalidateField', 'description');
            $('#pageEditForm').formValidation('revalidateField', 'meta_title');
            
        })
        .find('[name="description"]')
                .each(function () {
                    $(this)
                        .ckeditor({
                            allowedContent: true,
                            removePlugins: 'sourcearea' // disable source area
                        })
                        .editor
                        .on('change', function (e) {
                            $('#pageEditForm').formValidation('revalidateField', e.sender.name);
                        });
                });
    });
</script>

@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Page</h3>
</div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="pageEditForm" method="POST" action="{{ route('admin.content-management.page.update', $page->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Main Page *</label>
            <select name="parent_id" class="form-control">
                <option value="0">Main Page Itself</option>
                @foreach($parents as $parent)
                    <option value="{!! $parent->id !!}"
                        @if($parent->id == $page->parent_id) selected="selected" @endif>{!! $parent->heading !!}</option>
                 @endforeach
            </select>
        </div>

        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="heading">Heading *</label>
                <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading." value="{{ $page->heading }}" >
            </div>
           
            <div class="form-group">
                <label for="description">Description *</label>
                <textarea class="form-control" id="description" name="description">{{ $page->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Attachment *</label>
    
                <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" >
                            @if(file_exists('uploads/content-management/page/'.$page->attachment) && $page->attachment != '')
                                <img src="{{ asset('uploads/content-management/page/'.$page->attachment) }}" alt="{{ $page->name }}">
                            @else
                                <img src="{{ asset('uploads/content-management/page/default-img.jpg') }}" alt="default-image">
                            @endif
                        </div>
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 300px; max-height: auto; line-height: 20px;">
                    </div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-undo"></i> Change photo</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change photo</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
                <span>Photo file format should be in jpg, jpeg and png.</span>
            </div>
            <div class="form-group">
                <label for="breadcrumb_attachment">BreadCrumb Attachment *</label>
    
                <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" >
                            @if(file_exists('uploads/content-management/page/'.$page->breadcrumb_attachment) && $page->breadcrumb_attachment!='')
                             <img src="{{ asset('uploads/content-management/page/'.$page->breadcrumb_attachment) }}" alt="{{ $page->name }}">
                            @else
                            <img src="{{ asset('uploads/content-management/page/default-img.jpg') }}" alt="default-image">
                            @endif
                        </div>
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 300px; max-height: auto; line-height: 20px;">
                    </div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-undo"></i> change photo</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change photo</span>
                        <input type="file" name="breadcrumb_attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
                <span>Photo file format should be in jpg, jpeg and png.</span>
            </div>

            <div class="form-group ">
                <label for="">Order Position</label>
                <div class="form-line">
                <input type="number" name="order_position" value="{{ $page->order_position }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="is_active">
                <option value="1" {{ ($page->is_active == 1) ? 'selected=selected' : '' }}>Active</option>
                <option value="0" {{ ($page->is_active == 0) ? 'selected=selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>
        <!-- /.box-body -->

        <!-- /.box-body -->
    
        <div class="box-header box-footer with-border">
            <h3 class="box-title">SEO Information</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label for="meta_title">Meta Title *</label>
                <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Enter meta title." value="{{ $page->meta_title }}">
            </div>

            <div class="form-group">
                <label for="meta_tags">Meta Keywords *</label>
                <input type="text" name="meta_tags" class="form-control" id="meta_tags" placeholder="Enter meta keywords." value="{{ $page->meta_tags }}">
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description *</label>
                <textarea type="text" name="meta_description" class="form-control" id="meta_description" placeholder="Enter meta description.">{{ $page->meta_description }}</textarea>
            </div>
        </div>

        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <input type="hidden" name="_method" value="PUT">

    </form>
</div>

@endsection