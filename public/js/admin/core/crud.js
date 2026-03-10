class CrudService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl;
    }

    index(cb) {
        $.get(this.baseUrl, cb);
    }

    show(id, cb) {
        $.get(`${this.baseUrl}/${id}`, cb);
    }

    store(data, cb, err) {
        $.post(this.baseUrl, data)
            .done(cb)
            .fail(err);
    }

    update(id, data, cb, err) {
        $.ajax({
            url: `${this.baseUrl}/${id}`,
            method: 'PUT',
            data: data
        }).done(cb).fail(err);
    }

    destroy(id, cb) {
        $.ajax({
            url: `${this.baseUrl}/${id}`,
            method: 'DELETE'
        }).done(cb);
    }
}
