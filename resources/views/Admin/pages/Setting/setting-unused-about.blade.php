@extends('Admin.layout.master')
@section('content')
    <style>
        <style>

        /* Match Select2 with Bootstrap's form-select */
        .select2-container .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            height: auto;
            background-color: #fff;
        }

        .select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd;
            border: none;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            margin-right: 0.25rem;
        }

        .select2-container .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            margin-right: 0.25rem;
            cursor: pointer;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice:hover {
            background-color: #0056b3;
        }

        .select2-container--default .select2-results>.select2-results__options {
            max-height: 300px;
            /* Optional: Limit dropdown height */
            overflow-y: auto;
        }
    </style>

    </style>
    <div class="container-fluid">
        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span class="text-danger">*</span>) symbol represent
            that the field is required</span>
        <div class="card p-3">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <strong>{{ session()->get('success') }}</strong>
                </div>
                @endif @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>{{ session()->get('error') }}</strong>
                    </div>
                @endif
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        @csrf

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ $setting->title ?? '' }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="col-md-6">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                            @error('logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if ($setting->logo)
                                <div>
                                    <img src="{{ $setting->logo ?? '' }}" width="100" height="100" alt="Logo">
                                </div>
                            @endif
                        </div>

                        {{-- Primary Office --}}
                        <h5 class="mt-4 mb-2">Primary Office</h5>

                        <div class="col-md-3">
                            <label class="form-label">Contact 1</label>
                            <input type="number" name="contact" class="form-control" value="{{ $setting->contact ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Contact 2</label>
                            <input type="number" name="contact2" class="form-control"
                                value="{{ $setting->contact2 ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Landline 1</label>
                            <input type="number" name="landline1" class="form-control"
                                value="{{ $setting->landline1 ?? '' }}">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Email 1</label>
                            <input type="email" name="email" class="form-control" value="{{ $setting->email ?? '' }}">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Address 1</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ $setting->address ?? '' }}">
                        </div>

                        {{-- Secondary Office --}}
                        <h5 class="mt-4 mb-2">Secondary Office</h5>


                        <div class="col-md-3">
                            <label class="form-label">Secondary Contact 1</label>
                            <input type="number" name="phone3" class="form-control" value="{{ $setting->phone3 ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Secondary Contact 2</label>
                            <input type="number" name="phone4" class="form-control" value="{{ $setting->phone4 ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Secondary Office landline</label>
                            <input type="number" name="landline2" class="form-control"
                                value="{{ $setting->landline2 ?? '' }}">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Email 2</label>
                            <input type="email" name="email2" class="form-control" value="{{ $setting->email2 ?? '' }}">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Address 2</label>
                            <input type="text" name="address2" class="form-control"
                                value="{{ $setting->address2 ?? '' }}">
                        </div>

                        {{-- Description & Work Description --}}
                        {{-- <div class="col-md-12 mt-3">
                            <label class="form-label">Welcome Description</label>
                            <textarea class="form-control description" name="description" rows="3">{!! $setting->description ?? '' !!}</textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">About Description</label>
                            <textarea class="form-control description" name="work_description" rows="3">{!! $setting->work_description ?? '' !!}</textarea>
                        </div> --}}

                        {{-- Images --}}
                        {{-- <div class="col-md-6 mt-3">
                            <label class="form-label">Welcome Image</label>
                            <input type="file" name="welcome_image" class="form-control">
                            @if ($setting->welcome_image)
                                <img src="/storage/{{ $setting->welcome_image }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">About Image</label>
                            <input type="file" name="about_image" class="form-control">
                            @if ($setting->about_image)
                                <img src="/storage/{{ $setting->about_image }}" width="100" height="100">
                            @endif
                        </div> --}}

                        {{-- Social --}}
                        <div class="col-md-3 mt-3">
                            <label class="form-label">Facebook Url</label>
                            <input type="url" name="facebook_url" class="form-control"
                                value="{{ $setting->facebook_url ?? '' }}">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label class="form-label">GitHub Url</label>
                            <input type="url" name="github_url" class="form-control"
                                value="{{ $setting->github_url ?? '' }}">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label class="form-label">Twitter Url</label>
                            <input type="url" name="twitter_url" class="form-control"
                                value="{{ $setting->twitter_url ?? '' }}">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label class="form-label">Instagram Url</label>
                            <input type="url" name="instagram_url" class="form-control"
                                value="{{ $setting->instagram_url ?? '' }}">
                        </div>

                    </div>
                    <button class="btn btn-success mt-3 mb-3 text-center">Submit</button>
                </form>

        </div>
        <div class="card p-2">
            <div class="mt-4 fetch-multiple-columns">

                <h4 class="mt-3 mb-3">Working Hour</h4>
                <form id="addWorkingForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Days<span class="text-danger">*</span></label>
                            <select multiple class="form-select p-4 form-select-lg multiple-days-select" name="days[]"
                                id="multiple-days">
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thrusday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                            </select>
                            <p id="days-error" class="text-danger workingHourAlert"></p>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Starting Date<span
                                    class="text-danger">*</span></label>
                            <input type="time" name="starting_time" id="" class="form-control"
                                placeholder="" aria-describedby="helpId" />
                            <p id="starting_time-error" class="text-danger workingHourAlert"></p>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Ending Date<span
                                    class="text-danger">*</span></label>
                            <input type="time" name="ending_time" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            <p id="ending_time-error" class="text-danger workingHourAlert"></p>
                        </div>
                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary mt-1 addWorkingBtn">Add</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="fetch-working-details">
                        <thead>
                            <tr>
                                <th scope="col">Days</th>
                                <th scope="col">Starting Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
        @include('Admin.pages.Setting.settingmodal')
    </div>
@endsection


<tbody>

</tbody>
