@extends('layouts.backend.containerform')

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#albumEditForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    attachment: {
                        validators: {
                            file: {
                                extension: 'jpg,jpeg,png',
                                maxSize: 1048576,   // 1 * 1024 * 1024
                                message: 'The selected file is not valid or file size greater than 1 MB.'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name field is required.'
                            }
                        }
                    }
                }
            }).on('blur', '[name="name"]', function(e){
                $('#albumEditForm').formValidation('revalidateField', 'name');
            });
        });
    </script>
@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
            <h3 class="box-title">Edit Album</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="albumEditForm" method="POST" action="{{ route('admin.media.album.update', $album->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter album name." value="{{ $album->name }}">
            </div>

            <div class="form-group">
                <label for="attachment">Cover Photo Attachment *</label>

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 600px; height: auto;">
                        @if(file_exists('uploads/media/album/' . $album->attachment) && $album->attachment != '')
                            <img src="{{ asset('uploads/media/album/' . $album->attachment) }}" alt="{{ $album->name }}">
                        @else
                            <img src="{{ asset('uploads/media/album/default-img.jpg') }}" alt="{{ $album->name }}">
                        @endif
                        
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 600px; max-height: auto; line-height: 20px;"></div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-file-pencil"></i> Change photo</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change photo</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
                <span>photo file format should be in jpg, jpeg and png.</span>

            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="is_active">
                <option value="1" {{ ($album->is_active == "1") ? 'selected=selected' : '' }}>Published</option>
                <option value="0" {{ ($album->is_active == "0") ? 'selected=selected' : '' }}>Unpublished</option>
                </select>
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