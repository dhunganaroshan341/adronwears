class ImageService {
    constructor(uploadUrl) {
        this.uploadUrl = uploadUrl;
    }

    upload(file, cb, err) {
        let formData = new FormData();
        formData.append('image', file);

        $.ajax({
            url: this.uploadUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false
        }).done(cb).fail(err);
    }
}
