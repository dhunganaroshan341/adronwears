<!-- Modal -->
@if ($popupNotice)
<div class="modal fade" id="popupNoticeModal" tabindex="-1" aria-labelledby="contactFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 p-0 position-relative overflow-hidden">
            <!-- Close button container - moved to right side -->
            <div class="button-container rounded-circle position-absolute end-0 me-3 mt-3" style="z-index: 1051;">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                    style="width: 32px; height: 32px; border: none; padding: 0; cursor: pointer;">
                </button>
            </div>
            <!-- Image with overlay title -->
            <a href="{{ $popupNotice->url }}" class="position-relative d-block">
                <img src="{{ $popupNotice->image ?? asset('/template/yatri_world/main-file/images/india.jpg') }}"
                    alt="Popup Image" class="w-100 d-block">
                <div class="overlay-text-container">
                    <div class="overlay-text-content">
                        {{ $popupNotice->title }}
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endif
@push('styles')
    <style>
        /* Modal backdrop and container */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-open .modal .modal-dialog .modal-content {
            border: none;
            position: relative;
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Close button container - positioned on right side */
        .button-container {
            background: var(--omundum-green);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            top: 15px;
            right: 15px;
        }

        /* Hover and active state for close button container */
        .button-container:hover,
        .button-container:active {
            background: #f06925;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        /* Use Bootstrap's white close icon */
        .btn-close-white {
            filter: brightness(0) invert(1);
            opacity: 1;
            transition: transform 0.2s ease;
        }

        .button-container:hover .btn-close-white {
            transform: rotate(90deg);
        }

        /* Image styling */
        .modal-content img {
            border-radius: 12px;
            max-height: 70vh;
            object-fit: cover;
        }

        /* Overlay text container - centered at bottom */
        .overlay-text-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4), transparent);
            padding: 30px 20px 20px 20px;
            z-index: 1050;
            transition: all 0.3s ease;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* Centered text content */
        .overlay-text-content {
            color: white;
            font-weight: 500;
            font-size: 1.2rem;
            text-align: center;
            line-height: 1.4;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            max-width: 90%;
            margin: 0 auto;
        }

        /* Hover effect for the entire link */
        a.position-relative:hover .overlay-text-container {
            background: linear-gradient(to top, rgba(97, 180, 136, 0.9), rgba(97, 180, 136, 0.5), transparent);
        }

        a.position-relative:hover .overlay-text-content {
            transform: translateY(-2px);
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.7);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 20px;
            }

            .button-container {
                width: 35px;
                height: 35px;
                top: 10px;
                right: 10px;
            }

            .btn-close-white {
                width: 28px;
                height: 28px;
            }

            .overlay-text-content {
                font-size: 1rem;
                padding: 15px 10px 10px 10px;
            }

            .modal-content img {
                max-height: 60vh;
            }
        }

        @media (max-width: 576px) {
            .overlay-text-content {
                font-size: 0.9rem;
            }

            .button-container {
                width: 32px;
                height: 32px;
            }

            .btn-close-white {
                width: 24px;
                height: 24px;
            }
        }

        /* Animation for modal appearance */
        .modal.fade .modal-dialog {
            transform: scale(0.8) translateY(-50px);
            transition: all 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: scale(1) translateY(0);
        }

        /* Custom scrollbar for long text if needed */
        .overlay-text-content::-webkit-scrollbar {
            width: 4px;
        }

        .overlay-text-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .overlay-text-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        /* Focus states for accessibility */
        .button-container:focus-within {
            outline: 2px solid #fff;
            outline-offset: 2px;
        }

        .btn-close:focus {
            box-shadow: none;
        }
    </style>
@endpush

@push('scripts')
    @if(!empty($popupNotice))
        <script>
            $(document).ready(function() {
                // Show modal on page load
                $('#popupNoticeModal').modal('show');

                // Add smooth close animation
                $('#popupNoticeModal').on('hide.bs.modal', function() {
                    $(this).find('.modal-dialog').addClass('animate-out');
                });

                // Reset animation class when modal is hidden
                $('#popupNoticeModal').on('hidden.bs.modal', function() {
                    $(this).find('.modal-dialog').removeClass('animate-out');
                });

                // Optional: Auto-close after a certain time
                // setTimeout(function() {
                //     $('#popupNoticeModal').modal('hide');
                // }, 10000); // 10 seconds

                // Prevent modal from closing when clicking on the image/content
                $('#popupNoticeModal .modal-content').on('click', function(e) {
                    e.stopPropagation();
                });

                // Optional: Track modal interactions for analytics
                $('#popupNoticeModal').on('shown.bs.modal', function() {
                    console.log('Popup notice modal opened');
                });

                $('#popupNoticeModal').on('hidden.bs.modal', function() {
                    console.log('Popup notice modal closed');
                });

                // Handle keyboard navigation
                $(document).on('keydown', function(e) {
                    if ($('#popupNoticeModal').hasClass('show')) {
                        if (e.key === 'Escape') {
                            $('#popupNoticeModal').modal('hide');
                        }
                    }
                });
            });
        </script>
    @endif
@endpush
