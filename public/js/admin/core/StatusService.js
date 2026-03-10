class StatusService {
    constructor(url) {
        this.url = url;
    }

    toggle(cb) {
        $.ajax({
            url: this.url,
            method: 'GET'
        }).done(cb);
    }
}
