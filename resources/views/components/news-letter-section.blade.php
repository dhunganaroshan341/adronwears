 <section class="newsletter-area m-0 pb-5 pt-5 bg-navy">
     <div class="container">
         <div class="newsletter-main">
             <div class="newsletter-wrapper">
                 <div class="row d-flex align-items-center justify-content-between">
                     <div class="col-lg-5">
                         <div class="newsletter-content-wrapper d-sm-flex align-items-center">
                             <div class="newsletter-icon">
                                 <i class="fa fa-envelope-open white"></i>
                             </div>
                             <div class="newsletter-content ms-4">
                                 <h3 class="title white mb-1">SUBSCRIBE <span>Now!</span> </h3>
                                 <p class="m-0 white">Get the latest trekking updates, travel tips, and exclusive offers
                                     delivered straight to your inbox.</p>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-7">
                         <div class="newsletter-form">
                             <form id="newsletter-form-submit" action="#">
                                 <input name="email" type="text" placeholder="Enter Your Email...">
                                 <button class="nir-btn">subscribe</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 @push('scripts')
     <script>
         $('#newsletter-form-submit').on('submit', function(e) {
             e.preventDefault();
             let email = $(this).find('input[name="email"]').val();

             $.ajax({
                 url: "{{ route('newsletter.subscribe') }}",
                 method: "POST",
                 data: {
                     email: email,
                     _token: "{{ csrf_token() }}"
                 },
                 success: function(response) {
                     Swal.fire({
                         title: "Subscribed!",
                         text: response.message,
                         icon: "success",
                         confirmButtonText: "OK"
                     });
                     $('#newsletter-form')[0].reset();
                 },
                 error: function(xhr) {
                     if (xhr.status === 409) {
                         // Already subscribed
                         Swal.fire({
                             title: "Already Subscribed",
                             text: xhr.responseJSON.message,
                             icon: "info",
                             confirmButtonText: "OK"
                         });
                     } else {
                         Swal.fire({
                             title: "Oops!",
                             text: xhr.responseJSON?.message || 'Subscription failed',
                             icon: "error",
                             confirmButtonText: "Try Again"
                         });
                     }
                 }
             });
         });
     </script>
 @endpush
