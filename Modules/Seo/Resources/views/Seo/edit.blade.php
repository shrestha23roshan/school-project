@extends('layouts.backend.containerform')

@section('dynamicdata')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Seo</h3>
    </div>
    <!-- /.box-header -->

    <!-- form start -->
    <form id="seoUpdateForm" role="form" method="POST" action="{{ route('admin.seo.update', $seo->id) }}">
        {{ csrf_field() }}
        <div class="box-body">
            @include('layouts.backend.alert')

            <div class="form-group">
                    <label for="meta_title">Meta Title *</label>
                    <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Enter meta title." value="{{ $seo->meta_title }}">
                </div>
    
                <div class="form-group">
                    <label for="meta_tags">Meta Keywords *</label>
                    <input type="text" name="meta_tags" class="form-control" id="meta_tags" placeholder="Enter meta keywords." value="{{ $seo->meta_tags }}">
                </div>
    
                <div class="form-group">
                    <label for="meta_description">Meta Description *</label>
                    <textarea type="text" name="meta_description" class="form-control" id="meta_description" placeholder="Enter meta description.">{{ $seo->meta_description }}</textarea>
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

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#seoUpdateForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
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
            }).on('blur', '[name="headline"]', function(e){
                $('#seoUpdateForm').formValidation('revalidateField', 'meta_title');
                $('#seoUpdateForm').formValidation('revalidateField', 'meta_tags');
                $('#seoUpdateForm').formValidation('revalidateField', 'meta_description');
            });
        });
    </script>
@endsection 
