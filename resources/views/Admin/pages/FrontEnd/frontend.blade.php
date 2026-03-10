@extends('Admin.layout.master')
@section('content')
    {{-- <h1 class="text-center">Hello world</h1> --}}
    <div class="container-fluid">
        <div class="card">
            <h1 class="text-center">Front End </h1>
        </div>
        <form action="" method="POST">
            <div class="card p-2">
                @if (session()->has('message'))
                    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>{{ session()->get('message') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>{{ session()->get('error') }}</strong>
                    </div>
                @endif
                <div class="row">
                    <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span class="text-danger">*</span>)
                        symbol represent that the field is required</span>
                    <div class="col-md-12">
                        <input type="hidden" name="frontend_id" value="{{ $frontend->id }}">
                        <label for="" class="form-label">Title<span class="text-danger">*</span> (About Us)</label>
                        <input type="text" name="about_us_title" id=""
                            class="form-control @error('about_us_title') is-invalid @enderror" placeholder=""
                            value="{{ $frontend->about_us_title ?? '' }}" />
                        @error('about_us_title')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    @csrf

                    <div class="col-md-12 mt-4">
                        <label for="" class="form-label">Description<span class="text-danger">*</span> (About
                            Us)</label>
                        <textarea name="about_us_description"
                            class="form-control summernote @error('about_us_description') is-invalid @enderror" id="" cols="30"
                            rows="10">{{ $frontend->about_us_description ?? '' }}</textarea>
                        @error('about_us_description')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="" class="form-label">Value Title<span class="text-danger">*</span> (About
                            Us)</label>
                        <input type="text" name="about_us_value" id=""
                            class="form-control @error('about_us_value') is-invalid @enderror" placeholder=""
                            value="{{ $frontend->about_us_value ?? '' }}" />
                        @error('about_us_value')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="" class="form-label">Value Description<span class="text-danger">*</span> (About
                            Us)</label>
                        <textarea name="about_us_value_description"
                            class="form-control summernote @error('about_us_value_description') is-invalid @enderror" id=""
                            cols="30" rows="10">{{ $frontend->about_us_value_description ?? '' }}</textarea>

                        @error('about_us_value_description')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-4">
                        <label for="" class="form-label">Email<span class="text-danger">*</span> (Contact
                            Us)</label>
                        <input type="email" name="contact_us_email" id=""
                            class="form-control @error('contact_us_email') is-invalid @enderror" placeholder=""
                            value="{{ $frontend->contact_us_email ?? '' }}" />
                        @error('contact_us_email')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-4">
                        <label for="" class="form-label">Address<span class="text-danger">*</span> (Contact
                            Us)</label>
                        <input type="text" name="contact_us_address" id=""
                            class="form-control @error('contact_us_address') is-invalid @enderror" placeholder=""
                            value="{{ $frontend->contact_us_address ?? '' }}" />
                        @error('contact_us_address')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-4 mb-2">
                        <label for="" class="form-label">Number<span class="text-danger">*</span> (Contact
                            Us)</label>
                        <input type="text" name="contact_us_number" id=""
                            class="form-control @error('contact_us_number') is-invalid @enderror" placeholder=""
                            value="{{ $frontend->contact_us_number ?? '' }}" />
                        @error('contact_us_number')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary float-right mt-2">Update</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $(".summernote").summernote();
        })
    </script>
@endsection
