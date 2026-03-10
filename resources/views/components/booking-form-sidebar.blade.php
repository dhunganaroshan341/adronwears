<form id="booking-form" class="form-content" method="POST" action="{{ route('packages.book') }}">
    @csrf
    <input type="hidden" name="tour_package_id" value="{{ $package->id }}">

    <h4 class="title white text-center">MAKE A BOOKING</h4>
    <div class="row gy-4">

        <!-- Full Name -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>

        <!-- Email -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Email Address</label>
                <input type="email" name="email" class="form-control" required placeholder="example@email.com">
            </div>
        </div>

        <!-- Phone -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Phone Number</label>
                <input type="text" name="phone" class="form-control" required placeholder="Eg:+97798619830">
            </div>
        </div>
        <!-- Country Dropdown -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Country</label>
                <select name="country" class="nice-select" required>
                    <option value="" disabled selected>Select your country</option>
                    @foreach ($countries as $countryCode => $data)
                        <option value="{{ $countryCode }}|{{ $data['name'] }}">{{ $data['name'] }}

                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Toggle Date Option -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Select Booking Type</label>
                <div>
                    <label class="me-3">
                        <input type="radio" name="booking_type" value="batch"> Batch Date
                    </label>
                    <label>
                        <input type="radio" name="booking_type" value="custom" checked> Custom Date
                    </label>
                </div>
            </div>
        </div>

        <!-- Batch Selection -->
        <div class="col-lg-12" id="batch-date-section" style="display:none;">
            <div class="form-group">
                <label class="white d-block mb-2">Select Batch</label>
                @if ($package->batches->count() > 0)
                    <select name="tour_batch_id" class="nice-select">
                        <option value="">-- Select a Batch --</option>
                        @foreach ($package->batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->start_date->format('Y-m-d') }}</option>
                        @endforeach
                    </select>
                @else
                    <div class="text-light bg-secondary p-2 rounded">
                        No batch available for this package. You can select the custom date.
                    </div>
                @endif
            </div>
        </div>

        <!-- Custom Date Selection -->
        <div class="col-lg-12" id="custom-date-section">
            <div class="form-group">
                <label class="white d-block mb-2">Select Custom Date</label>
                <input type="date" name="custom_date" class="form-control" id="customDateInput">
            </div>
        </div>

        <!-- Number of People -->
        <!-- Number of People -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">No. Of People</label>
                <div class="d-flex gap-2">
                    <input type="number" name="total_people" class="form-control" placeholder="" min="1">
                </div>
            </div>
        </div>

        <!-- Optional Message -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Message (Optional)</label>
                <textarea name="message" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <!-- With this -->


        <!-- Submit -->
        <div class="col-lg-12">
            <div class="form-group mb-0">
                <button type="submit" id="booking-submit-btn" class="nir-btn w-100">Book Now</button>

            </div>
        </div>

    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customRadio = document.querySelector('input[name="booking_type"][value="custom"]');
            const batchSection = document.getElementById('batch-date-section');
            const customSection = document.getElementById('custom-date-section');
            const submitBtn = document.getElementById('booking-submit-btn');
            const form = $('#booking-form');

            // Default: custom date selected
            customRadio.checked = true;
            batchSection.style.display = 'none';
            customSection.style.display = 'block';

            // Toggle between batch and custom
            document.querySelectorAll('input[name="booking_type"]').forEach(el => {
                el.addEventListener('change', function() {
                    if (this.value === 'batch') {
                        batchSection.style.display = 'block';
                        customSection.style.display = 'none';
                    } else {
                        batchSection.style.display = 'none';
                        customSection.style.display = 'block';
                    }
                });
            });

            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('customDateInput').value = today;

            // Prevent multiple submissions
            let isSubmitting = false;

            form.on('submit', function(e) {
                e.preventDefault();
                if (isSubmitting) return; // block double-submit
                isSubmitting = true;

                submitBtn.disabled = true;
                submitBtn.innerText = "Processing...";

                let formData = $(this).serialize();
                let actionUrl = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            form[0].reset();
                            $('.nice-select').val('').trigger('change');
                            // reset button state
                            submitBtn.disabled = false;
                            submitBtn.innerText = "Book Now";
                            isSubmitting = false;
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors || {};
                        let firstError = Object.values(errors)[0]?.[0] ||
                            'An error occurred. Please try again.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: firstError,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // reset button state
                            submitBtn.disabled = false;
                            submitBtn.innerText = "Book Now";
                            isSubmitting = false;
                        });
                    }
                });
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        /* Sidebar reCAPTCHA scaling */
        .sidebar .g-recaptcha {
            transform: scale(0.85);
            transform-origin: top center;
            background: #ffffff4d !important;
            color: #fff !important;
        }

        .g-recaptcha label {

            color: #fff !important;
        }

        .rc-anchor-light {
            background: #ffffff4d !important;
            color: #fff !important;
        }
    </style>
@endpush
