@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <form id="updateSiteData" method="POST" enctype="multipart/form-data">
            <div class="row">
                <h6>Note: All the Fields with <span class="text-danger">*</span> on it is mandatory</h6>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>{{ session()->get('success') }}</strong>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>{{ session()->get('error') }}</strong>
                    </div>
                @endif

                <div class="col-md-6">
                    <label for="" class="form-label">Site Name<span class="text-danger">*</span></label>
                    <input type="text" name="site_title" id=""
                        class="form-control @error('site_title')is-invalid @enderror" placeholder=""
                        value="{{ $siteData->site_name ?? '' }}" />
                    @error('site_title')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    @csrf
                    <label for="" class="form-label">Site Logo<span class="text-danger">*</span></label>
                    <input type="file" name="site_logo" id=""
                        class="form-control @error('site_logo')is-invalid @enderror" placeholder="" />
                        <div>
                            <img src="{{ asset('storage/'. $siteData->site_image) }}" alt="" width="100" height="100" srcset="">
                        </div>
                    @error('site_logo')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label for="" class="form-label">Working Hour Description</label>
                    <textarea name="site_description" class="form-control workingDescription" id="" cols="30"
                        rows="10">{!! $siteData->site_description !!}</textarea>
                </div>

                <div class="row mt-3 mb-3">
                    <h4 class=" mt-3 mb-4 fetch-shedule-data">Office Shedule Time</h4>
                    <div class="row mt-2 mb-2">
                        <div class="col-md-3">
                            <label for="" class="form-label">Starting Day<span class="text-danger">*</span></label>
                            <select class="form-select" name="starting_days[]" id="">

                                <option value="">Select one</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('starting_days[]')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">End Day<span class="text-danger">*</span></label>
                            <select class="form-select" name="ending_days[]" id="">

                                <option value="">Select one</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('ending_days')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="" class="form-label">Starting Time<span class="text-danger">*</span></label>
                            <input type="time" name="starting_time[]" id="" class="form-control"
                                placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Ending Time<span class="text-danger">*</span></label>
                            <input type="time" name="ending_time[]" id="" class="form-control" placeholder="" />
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="button" class="btn btn-primary mt-1 addMoreBtn">Add More</button>
                            <button type="button" class="btn btn-danger mt-1 removeBtn" disabled>Remove</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $(".workingDescription").summernote({
                height: "300px"
            });

            // Add More Button
            $(document).on("click", ".addMoreBtn", function() {
                let data = `
        <div class="row moreSheduleDataFetch mt-2 mb-2">
                        <div class="col-md-3">
                            <label for="" class="form-label">Starting Day</label>
                            <select class="form-select" name="starting_days[]" id="">

                                <option value="">Select one</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">End Day</label>
                            <select class="form-select" name="ending_days[]" id="">

                                <option value="">Select one</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="" class="form-label">Starting Time</label>
                            <input type="time" name="starting_times[]" id="" class="form-control" placeholder="" />
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Ending Time</label>
                            <input type="time" name="ending_times[]" id="" class="form-control" placeholder="" />
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="button" class="btn btn-primary mt-1 addMoreBtn">Add More</button>
                            <button type="button" class="btn btn-danger mt-1 removeBtn">Remove</button>
                        </div>
        </div>`;

                $(".fetch-shedule-data").append(data);
            });

            $(document).on("click", ".removeBtn", function() {
                $(this).closest(".moreSheduleDataFetch").remove();
            });


        })
    </script>
@endsection
