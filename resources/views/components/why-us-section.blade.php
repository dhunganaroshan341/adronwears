 <!-- why us starts -->
 <div class="why-us pt-4 border-t">
     <div class="why-us-box">
         <div class="section-title text-center mb-5 pb-2 w-50 mx-auto">
             <h2 class="m-0">Why <span> Us</span></h2>

         </div>
         <div class="row">
             <div class="col-lg-3 col-md-6 mb-4">
                 <div class="why-us-item text-center bg-lgrey">
                     <div class="why-us-icon mb-2">
                         <i class="flaticon-call orange"></i>
                     </div>
                     <div class="why-us-content">
                         <h4><a href="#">Guides</a></h4>
                         <p class="mb-0">Travel worry free knowing that we're here if you need us, 24
                             hours a day</p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 mb-4">
                 <div class="why-us-item text-center bg-lgrey">
                     <div class="why-us-icon mb-2">
                         <i class="flaticon-global orange"></i>
                     </div>
                     <div class="why-us-content">
                         <h4><a href="#">Flight Tickets</a></h4>
                         <p class="mb-0">Travel worry free knowing that we're here if you need us, 24
                             hours a day</p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 mb-4">
                 <div class="why-us-item text-center bg-lgrey">
                     <div class="why-us-icon mb-2">
                         <i class="flaticon-building orange"></i>
                     </div>
                     <div class="why-us-content">
                         <h4><a href="#">Hotel Services</a></h4>
                         <p class="mb-0">Travel worry free knowing that we're here if you need us, 24
                             hours a day</p>
                     </div>
                 </div>
             </div>

             <div class="col-lg-3 col-md-6 mb-4">
                 <div class="why-us-item text-center bg-lgrey">
                     <div class="why-us-icon mb-2">
                         <i class="flaticon-location-pin orange"></i>
                     </div>
                     <div class="why-us-content">
                         <h4><a href="#">Trekkings</a></h4>
                         <p class="mb-0">Travel worry free knowing that we're here if you need us, 24
                             hours a day</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- why us ends -->
 @push('styles')
     <style>
         /* Disable pointer events and hand cursor on all clickable elements inside why-us */
         .why-us a,
         .why-us [class*="flaticon"],
         .why-us h4,
         .why-us .why-us-item,
         .why-us .why-us-content,
         .why-us * {
             /* pointer-events: none !important; */
             cursor: default !important;
             /* text-decoration: none !important;
                     color: inherit !important; */
         }
     </style>
 @endpush
