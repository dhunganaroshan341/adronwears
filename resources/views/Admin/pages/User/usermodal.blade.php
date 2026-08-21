<div class="modal fade"
     id="formModal"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form id="formId" class="form" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="formModalTitle">
                        Add User
                    </h1>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>


                <div class="modal-body">

                    {{-- Validation Errors --}}
                    <div
                        id="validationErrors"
                        class="alert alert-danger d-none">
                    </div>


                    <div class="row">

                        <div class="col-12">

                            <span class="mt-2 mb-2 d-block">
                                <span class="text-danger">Note:</span>
                                (<span class="text-danger">*</span>)
                                represents a required field.
                            </span>

                        </div>


                        {{-- ================================================= --}}
                        {{-- FULL NAME --}}
                        {{-- ================================================= --}}

                        <div class="col-md-6">

                            <label for="full_name" class="form-label">
                                Full Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="full_name"
                                id="full_name"
                                class="form-control"
                                required
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- POSITION --}}
                        {{-- ================================================= --}}

                        <div class="col-md-6">

                            <label for="position" class="form-label">
                                Position
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="position"
                                id="position"
                                class="form-control"
                                required
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- EMAIL --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="email" class="form-label">
                                Email
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                required
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- PASSWORD --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6 labelPassword">

                            <label for="password" class="form-label">
                                Password

                                <span
                                    class="text-danger passwordRequired">
                                    *
                                </span>
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                autocomplete="new-password"
                            >

                            <div class="mt-2 form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="checkbox"
                                >

                                <label
                                    class="form-check-label"
                                    for="checkbox">
                                    Show Password
                                </label>

                            </div>

                            <small
                                id="passwordHelp"
                                class="text-muted">
                            </small>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PHONE --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="phonenumber" class="form-label">
                                Phone Number
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="phonenumber"
                                id="phonenumber"
                                class="form-control"
                                required
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- EMAIL LINK --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="email_link" class="form-label">
                                Email Link
                            </label>

                            <input
                                type="email"
                                name="email_link"
                                id="email_link"
                                class="form-control"
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- FACEBOOK --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="facebook_link" class="form-label">
                                Facebook Link
                            </label>

                            <input
                                type="url"
                                name="facebook_link"
                                id="facebook_link"
                                class="form-control"
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- INSTAGRAM --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="instagram_link" class="form-label">
                                Instagram Link
                            </label>

                            <input
                                type="url"
                                name="instagram_link"
                                id="instagram_link"
                                class="form-control"
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- TWITTER --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="twitter_link" class="form-label">
                                Twitter Link
                            </label>

                            <input
                                type="url"
                                name="twitter_link"
                                id="twitter_link"
                                class="form-control"
                            >

                        </div>


                        {{-- ================================================= --}}
                        {{-- IMAGE --}}
                        {{-- ================================================= --}}

                        <div class="mt-2 mb-2 col-md-6">

                            <label for="image" class="form-label">
                                Image
                            </label>

                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control"
                                accept="image/*"
                            >

                            <div id="userImage" class="mt-2"></div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- NOTES --}}
                        {{-- ================================================= --}}

                        <div class="mt-4 mb-2 col-md-12">

                            <label for="notes_user" class="form-label">
                                Notes
                            </label>

                            <textarea
                                class="form-control summernote"
                                id="notes_user"
                                name="notes"
                                rows="4">
                            </textarea>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>


                    <button
                        type="submit"
                        class="btn btn-outline-dark submitBtn">
                        Submit
                    </button>


                    <button
                        type="submit"
                        class="btn btn-outline-dark updateBtn d-none">
                        Update User
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
