Dropzone.autoDiscover = false;

/** get url and split it */
var segments = window.location.href.split('/');
var baseUrl = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
var url, id, method, type, removeLink;

// console.log('base URL: '+baseUrl);
// console.log('segments: '+segments);
if (segments[8] === 'create') {
    type = 'POST';
    id = segments[6];
    url = "/admin/media/album/" + id + "/photo/store";
    removeLink = true;
} else if (segments[9] === 'edit') {
    type = 'PUT';
    id = segments[8];
    method = segments[9];
    url = baseUrl + "/admin/media/album/photos/" + id;
    removeLink = true;
} 

$("#mydropzone").dropzone({
    url: url,
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 10,
    maxFilesize: 1, // Max file upload size constraint is 1 MB
    maxFiles: 10,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: removeLink,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 1MB',
    timeout: 10000,
    renameFile: function (file) {
        file.rename = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
        return file.rename;
    },
    init: function () {
        var myDropzone = this;

        /** Alert for max file exceeded */
        this.on("maxfilesexceeded", function (file) {
            alert("Maximum files limit exceeded.");
            myDropzone.removeFile(file);
        });

        // form submit button
        $("#submit").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                /** Form submit with no photo files selected */
                swal('Oops...', 'Please select photo.' ,'error').catch(swal.noop);
            }
            else {
                myDropzone.processQueue();
            }
        });

        this.on('sending', function (files, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            
        });

        /** Call once after completion of multiple file upload */
        this.on("successmultiple", function (files, response) {
            /** Redirect to works index */
            // console.log('success message: '+response.message);
            // console.log('original_name: '+response.original_name);
            window.location.href = "/admin/media/album/" + id + "/photo";
        });

        /** Catch error and show error message */
        this.on("errormultiple", function (file, message) {

        });

        /** For update form */
        if (method && id) {
            getPhotos(myDropzone, id);
        }
        /** End */

        this.on("removedfile", function (file) {
            if (segments[9] === 'edit') {
                $.post({
                    url: '/admin/media/album/photos/delete',
                    data: { name: file.rename, _token: $('[name="_token"]').val() },
                    dataType: 'json',
                    success: function (response) {
                        if (response.type == 'success') {
                            console.log('success message: ' + response.message);
                        } else {
                            console.log('error message: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        swal('Oops...', 'Something went wrong, please try again later!','error').catch(swal.noop);
                    }
                });
            }
        });
    }
});

/** Get all photos based on album id */
function getPhotos(myDropzone, id) {
    $.getJSON('/media/album/' + id + '/photos', function (response) { // get the json response
        $.each(response.data, function (key, item) { //loop through it
            let path = base_url + "uploads/media/album/" + item.name;

            let mockFile = {
                name: item.name,
                rename: item.rename,
                size: item.size,
                accepted: true,
                kind: 'image',
                upload: {
                    filename: item.name,
                },
                dataURL: path,
            };

            myDropzone.files.push(mockFile);
            myDropzone.emit("addedfile", mockFile);
            myDropzone.createThumbnailFromUrl(
                mockFile,
                myDropzone.options.thumbnailWidth,
                myDropzone.options.thumbnailHeight,
                myDropzone.options.thumbnailMethod,
                true,
                function (thumbnail) {
                    myDropzone.emit('thumbnail', mockFile, thumbnail);
                    myDropzone.emit("complete", mockFile); // Make sure that there is no progress bar, etc...
                }
            );
            // mockFile.previewElement.addEventListener("click", function () {
            //     myDropzone.removeFile(mockFile);
            // });
        });
    });
}