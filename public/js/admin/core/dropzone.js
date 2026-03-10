window.DropzoneService = function (selector, url, multiple = false) {
    return new Dropzone(selector, {
        url: url,
        maxFiles: multiple ? null : 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
};
