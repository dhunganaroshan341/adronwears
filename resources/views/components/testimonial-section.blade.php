 <section class="testimonial pb-6">
     <div class="container">
         <div class="section-title text-center mb-5 pb-2 w-50 mx-auto">
             <h2 class="m-0">What <span>People Say About Us</span></h2>
             <p class="mb-0">
                 Travel has helped us to understand the meaning of life and it has helped us become better
                 people. Each time we travel, we see the world with new eyes.
             </p>
         </div>

         <div class="review-slider owl-carousel">
             @foreach ($testimonials as $testimonial)
                 <div class="item">
                     <div class="testimonial-item1 text-center">
                         <div class="details">
                             <p class="m-0">{{ $testimonial->description }}</p>
                         </div>
                         <div class="author-info mt-2">
                             <a href="#">
                                 <img loading="lazy" alt="client"
                                     src="{{ $testimonial->image_url ?? asset('template/yatri_world/main-file/images/User.png') }}" />
                             </a>
                             <div class="author-title">
                                 <h4 class="m-0 pink">{{ $testimonial->name }}</h4>
                                 <span>{{ $testimonial->designation }}</span>
                             </div>
                         </div>
                         <i class="fa fa-quote-left mb-2"></i>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
