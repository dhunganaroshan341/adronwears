<div class="col-lg-3 d-none d-lg-block position-sticky top-0" style="z-index: 100;">
    <div class="section-container p-3 shadow-sm bg-white rounded">
        <div class="input-group sidebar-search">
            <input type="text" id="storySearchInput" class="form-control" placeholder="Search Our Blogs..." />
            <button class="btn btn-primary" id="storySearchBtn" type="button"><i class="fa fa-search"></i></button>
        </div>
        <div id="searchResults" class="mt-3"></div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addComment').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let submitButton = form.find('button[type="submit"]');
                submitButton.prop('disabled', true).text('Submitting...');

                $.ajax({
                    url: '/comment/store',
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        alert('Your comment has been submitted successfully!');

                        // Clear form fields
                        form[0].reset();

                        // Optionally: reload comments without full page reload
                        // location.reload(); // Uncomment to refresh the page
                    },
                    error: function(xhr) {
                        alert('Something went wrong. Please try again.');
                    },
                    complete: function() {
                        submitButton.prop('disabled', false).text('Submit Comment');
                    }
                });
            });

            $('#storySearchBtn').on('click', function() {
                const keyword = $('#storySearchInput').val().trim();

                if (!keyword) return alert('Please enter a search term.');

                $.ajax({
                    url: "{{ route('search.posts') }}",
                    method: "GET",
                    data: {
                        keyword
                    },
                    success: function(response) {
                        let html = '';
                        if (response.length > 0) {
                            html += '<ul class="list-group">';
                            response.forEach(post => {
                                html += `<li class="list-group-item bg-light">
                                    <a href="/blog/detail/${post.id}" class="text-dark search-result-text">${post.title}</a>
                                 </li>`;
                            });
                            html += '</ul>';
                        } else {
                            html = '<p>No stories found.</p>';
                        }
                        $('#searchResults').html(html);
                    },
                    error: function() {
                        $('#searchResults').html(
                            '<p class="text-danger">Error fetching results. Try again.</p>');
                    }
                });
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        .search-result-text:hover {
            color: var(--realm-blue) !important;
        }
    </style>
@endpush
