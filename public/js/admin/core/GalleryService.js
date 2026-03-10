class GalleryService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl;
    }

    upload(files, cb) {
        let fd = new FormData();
        [...files].forEach(f => fd.append('images[]', f));

        $.ajax({
            url: this.baseUrl,
            method: 'POST',
            data: fd,
            processData: false,
            contentType: false
        }).done(cb);
    }

    delete(imageId, cb) {
        $.ajax({
            url: `${this.baseUrl}/${imageId}`,
            method: 'DELETE'
        }).done(cb);
    }
}
