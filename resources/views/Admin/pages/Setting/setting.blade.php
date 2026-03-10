@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid py-4">
        <span class="d-block mb-4">
            <span class="text-danger">Note:</span> (<span class="text-danger">*</span>) symbol represents required fields
        </span>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Website Settings --}}
            <div class="card mb-4 p-4">
                <h4 class="mb-3">Website Settings</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ $setting->title ?? '' }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                        @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @if ($setting->logo)
                            <div class="mt-2">
                                <img src="{{ $setting->logo }}" width="100" height="100" alt="Logo">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Office Hours</label>
                        <input type="text" name="office_hours" class="form-control"
                            value="{{ $setting->office_hours ?? '' }}">
                    </div>

                </div>
            </div>

            {{-- Primary Office --}}
            <div class="card mb-4 p-4">
                <h4 class="mb-3">Primary Office</h4>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Contact 1</label>
                        <input type="number" name="contact" class="form-control" value="{{ $setting->contact ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Contact 2</label>
                        <input type="number" name="contact2" class="form-control" value="{{ $setting->contact2 ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Landline 1</label>
                        <input type="number" name="landline1" class="form-control" value="{{ $setting->landline1 ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email 1</label>
                        <input type="email" name="email" class="form-control" value="{{ $setting->email ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address 1</label>
                        <input type="text" name="address" class="form-control" value="{{ $setting->address ?? '' }}">
                    </div>
                </div>
            </div>

            {{-- Secondary Office --}}
            <div class="card mb-4 p-4">
                <h4 class="mb-3">Secondary Office</h4>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Contact 1</label>
                        <input type="number" name="phone3" class="form-control" value="{{ $setting->phone3 ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Contact 2</label>
                        <input type="number" name="phone4" class="form-control" value="{{ $setting->phone4 ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Landline</label>
                        <input type="number" name="landline2" class="form-control"
                            value="{{ $setting->landline2 ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email 2</label>
                        <input type="email" name="email2" class="form-control" value="{{ $setting->email2 ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address 2</label>
                        <input type="text" name="address2" class="form-control"
                            value="{{ $setting->address2 ?? '' }}">
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            <div class="card mb-4 p-4">
                <h4 class="mb-3">Social Links</h4>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-control"
                            value="{{ $setting->facebook_url ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">GitHub URL</label>
                        <input type="url" name="github_url" class="form-control"
                            value="{{ $setting->github_url ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" name="twitter_url" class="form-control"
                            value="{{ $setting->twitter_url ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-control"
                            value="{{ $setting->instagram_url ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
