@extends('Admin.layout.master')

@section('content')
<div class="container">
    <x-admin.breadcrumb />

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf

        @include('Admin.pages.products.partials.form')

        <button class="btn btn-outline-dark">Save</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImages(event) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-3';

                col.innerHTML = `
                <div class="border rounded p-2 text-center">
                    <img src="${e.target.result}" class="img-fluid rounded" style="height:150px;object-fit:cover;">
                </div>
            `;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
</script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description-editor'), {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'bulletedList',
                'numberedList',
                '|',
                'link',
                'blockQuote',
                '|',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush