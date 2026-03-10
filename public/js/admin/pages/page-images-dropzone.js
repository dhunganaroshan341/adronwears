// Dropzone.autoDiscover = false; // Disable auto init

// $(document).ready(function () {
//     $.ajaxSetup({
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
//     });

//     let pageImageDropzone;
//     let isResettingDropzone = false;

//     function resetPageUploadModal() {
//         if (pageImageDropzone) {
//             isResettingDropzone = true;
//             pageImageDropzone.removeAllFiles(true);
//             setTimeout(() => {
//                 isResettingDropzone = false;
//             }, 0);
//         }
//         $('#page_id').val('');
//         $('#uploadPageModal').modal('hide');
//     }

//     // Reset modal when closed
//     $('#uploadPageModal').on('hidden.bs.modal', function () {
//         resetPageUploadModal();
//     });

//     // Open modal and init Dropzone + load existing images
//     $(document).on('click', '.editPageUploads', function () {
//         const pageId = $(this).data('id');
//         $('#page_id').val(pageId);
//         $('#uploadPageModal').modal('show');

//         if (!pageImageDropzone) {
//             pageImageDropzone = new Dropzone("#pageDropzone", {
//                 url: window.routes.pageImageUpload, // Define your route in your blade or JS config
//                 paramName: "images",
//                 method: 'POST',
//                 acceptedFiles: "image/*",
//                 maxFilesize: 5, // MB
//                 uploadMultiple: true,
//                 parallelUploads: 5,
//                 autoProcessQueue: false,
//                 addRemoveLinks: true,
//                 dictDefaultMessage: "Drag & drop images here or click to upload",
//                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
//             });

//             pageImageDropzone.on('sending', function (file, xhr, formData) {
//                 formData.append('page_id', $('#page_id').val());
//             });

//             pageImageDropzone.on('successmultiple', function (files, response) {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Images Uploaded Successfully!',
//                     showConfirmButton: false,
//                     timer: 1500
//                 });
//                 pageImageDropzone.removeAllFiles(true);
//                 $('#uploadPageModal').modal('hide');
//             });

//             pageImageDropzone.on('errormultiple', function (files, response) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Upload Error',
//                     text: typeof response === 'string' ? response : 'Something went wrong. Please try again.'
//                 });
//                 console.error(response);
//             });

//             pageImageDropzone.on('removedfile', function (file) {
//                 if (isResettingDropzone) return;
//                 if (file.serverId) {
//                     $.ajax({
//                         url: `/admin/page-images/delete/${file.serverId}`,
//                         method: 'DELETE',
//                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                         success: function () {
//                             Swal.fire('Deleted!', 'Image has been deleted.', 'success');
//                         },
//                         error: function () {
//                             Swal.fire('Failed!', 'Could not delete image.', 'error');
//                         }
//                     });
//                 }
//             });
//         }

//         // Reset dropzone UI on modal open
//         pageImageDropzone.removeAllFiles(true);

//         // Load existing images from server
//         $.ajax({
//             url: `/admin/page-images/${pageId}`,
//             method: 'GET',
//             success: function (images) {
//                 images.forEach(function (image) {
//                     const mockFile = {
//                         name: image.image_path.split('/').pop(),
//                         size: image.size || 123456,
//                         accepted: true,
//                         serverId: image.id,
//                         status: Dropzone.SUCCESS
//                     };
//                     pageImageDropzone.emit('addedfile', mockFile);
//                     pageImageDropzone.emit('thumbnail', mockFile, image.image_url);
//                     pageImageDropzone.emit('complete', mockFile);
//                     pageImageDropzone.files.push(mockFile);
//                 });
//             },
//             error: function () {
//                 console.error('Failed to load existing images for page');
//             }
//         });
//     });

//     // Upload button click handler
//     $('#uploadPageSubmitBtn').click(function () {
//         if (!pageImageDropzone || pageImageDropzone.getAcceptedFiles().length === 0) {
//             Swal.fire({
//                 icon: 'warning',
//                 title: 'No Images Selected',
//                 text: 'Please add some images to upload.'
//             });
//             return;
//         }
//         pageImageDropzone.processQueue();
//     });

//     // Close modal button handler (if needed)
//     $('#closePageUploadBtn').click(function () {
//         $('#uploadPageModal').modal('hide');
//         resetPageUploadModal();
//     });
// });
