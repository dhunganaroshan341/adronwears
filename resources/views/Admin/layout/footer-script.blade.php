<!-- plugins:js -->
<script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>


<script src="{{ asset('admin/js/template.js') }}"></script>
<!-- DataTables JS -->
<!-- Summernote JS -->


{{-- Select 2 --}}

<!-- Core JS (always loaded) -->
<script src="{{ asset('js/admin/core/crud.js') }}"></script>
<script src="{{ asset('js/admin/core/datatable.js') }}"></script>
<script src="{{ asset('js/admin/core/form-modal.js') }}"></script>
<script src="{{ asset('js/admin/core/status.js') }}"></script>
<script src="{{ asset('js/admin/core/dropzone.js') }}"></script>


@isset($extraJs)
@foreach ($extraJs as $js)
<script src="{{ $js }}"></script>
@endforeach
@endisset


@php
$path = Request::path();
$dir_path = public_path() . '/js/' . $path;
if (is_dir($dir_path)) {
$directory = new DirectoryIterator($dir_path);
// Loop runs while directory is valid
while ($directory->valid()) {
if (!$directory->isDir()) {
$filename = url('js/' . $path . '/' . $directory->getFilename());
echo '
<script src="' . $filename . '?v=0.3.1"></script>';
}
// Move to the next element
$directory->next();
// dd($directory->next());
}
}
@endphp
@stack('scripts')
