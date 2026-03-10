$(document).ready(function() {
    $('#video').on('change', function() {
        const file = this.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            $('#videoPreview').remove();
            $('<video id="videoPreview" controls style="width: 100%; max-height: 400px; object-fit: cover; margin-top: 10px;"><source src="' + url + '" type="' + file.type + '"></video>').insertAfter('#video');
        }
    });
});
