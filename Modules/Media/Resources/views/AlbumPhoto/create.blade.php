@extends('layouts.backend.containerform')

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#photoAddForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
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
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name field is required.'
                            }
                        }
                    }
                }
            }).on('blur', '[name="name"]', function(e){
                $('#photoAddForm').formValidation('revalidateField', 'name');
            });
        });
    </script>
@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add Photo</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="photoAddForm" method="POST" action="{{ route('admin.media.album.photo.store', $album->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

        <!-- dropzone for multiple photo upload -->
        <div class="dropzone mt" id="mydropzone">
            <div class="dz-message">
                <div class="col-xs-12">
                    <div class="message mt">
                        <p>Drop files here or Click to Upload</p>
                    </div>
                </div>
            </div>
            <div class="fallback">
                <input type="file" name="file" multiple>
            </div>
        </div>
        <!-- End dropzone -->
        
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" id="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
    </form>
</div>

@endsection