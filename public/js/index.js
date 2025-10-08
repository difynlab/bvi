$(document).ready(function() {
    const moduleRoutes = window.moduleRoutes || {};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let editors = [];
    $('.add-button').on('click', function() {
        $('.form')[0].reset();

        $('#modal').one('shown.bs.modal', function () {
            $('.image-preview').empty();
            
            document.querySelectorAll('.editor').forEach(element => {
                const editorInstance = new FroalaEditor(element, {
                    imageUploadURL: '/admin/froala/upload',
                    imageUploadParam: 'upload',
                    imageMaxSize: 5 * 1024 * 1024,
                    requestHeaders: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    events: {
                        'image.uploaded': function (response) {
                            console.log('Uploaded:', response);
                        },
                        'image.error': function (error, response) {
                            console.error('Upload failed:', error);
                        },
                        'image.removed': function ($img) {
                            const imageSrc = $img.attr('src');
                            if (imageSrc) {
                                fetch('/admin/froala/delete', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({ src: imageSrc })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Image deleted:', data);
                                })
                                .catch(err => {
                                    console.error('Failed to delete image:', err);
                                });
                            }
                        }
                    }
                });

                editors.push(editorInstance);
            });
        });

        $('#modal').modal('show');
    });

    $('#modal').on('hidden.bs.modal', function () {
        editors.forEach(editor => {
            if(editor) {
                editor.destroy();
            }
        });

        editors = [];
    });

    $('.page').on('click', '.delete-button', function() {
        let id = $(this).attr('id');
        let url = moduleRoutes.destroyRoute.replace(':id', id);
        $('.page #delete-modal form').attr('action', url);
        $('.page #delete-modal').modal('show');
    });

    $('.page').on('change', '.custom-pagination select', function () {
        window.location = moduleRoutes.pageUrl + "&pagination=" + this.value;
    });
});

// #region: Handle image preview dynamically //
    function handleImagePreview(thumbnailData) {
        if(thumbnailData) {
            $('.image-preview').empty();
            let src = '/storage/events/' + thumbnailData;
            let img = `<img src="${src}"/>`;
            $('.image-preview').append(img);

            let link = `<a href="${src}" class="download-icon" title="download" download>
                            <i class="bi bi-arrow-bar-down"></i>
                        </a>`;
            $('.image-preview').append(link);
        }
    }
// #endregion //

// #region: Initialize Froala editors //
    function initializeEditors(data, csrfToken) {
        let editors = [];
        document.querySelectorAll('.editor').forEach(element => {
            let editorInstance = new FroalaEditor(element, {
                imageUploadURL: '/admin/froala/upload',
                imageUploadParam: 'upload',
                imageMaxSize: 5 * 1024 * 1024,
                requestHeaders: {
                    'X-CSRF-TOKEN': csrfToken
                },
                events: {
                    'image.uploaded': function (response) {
                        console.log('Uploaded:', response);
                    },
                    'image.error': function (error, response) {
                        console.error('Upload failed:', error);
                    },
                    'image.removed': function ($img) {
                        const imageSrc = $img.attr('src');
                        if (imageSrc) {
                            fetch('/admin/froala/delete', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({ src: imageSrc })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Image deleted:', data);
                            })
                            .catch(err => {
                                console.error('Failed to delete image:', err);
                            });
                        }
                    },
                    'initialized': function () {
                        if(data && data.content) {
                            editorInstance.html.set(data.content);
                        }
                    }
                }
            });

            editors.push(editorInstance);
        });

        return editors;
    }
// #endregion //

// #region: Modal open and destroy editors //
    function modalOpenDestroy() {
        // Show the modal
        $('#modal').modal('show');

        // Modal image preview
        $('.image-preview img').on('click', function() {
            let src = $(this).attr('src');
            $(".modal-image-preview").find('img').attr('src', src);
            $(".modal-image-preview").find('a').attr('href', src);
            $(".modal-image-preview").modal('show');
        });

        // Modal close cleanup
        $('#modal').on('hidden.bs.modal', function () {
            editors.forEach(editor => {
                if(editor) {
                    editor.destroy();
                }
            });
        });
    }
// #endregion //