 <section class="breadcrumb-main" style="background-image: url('{{ $pageBanner }}');">
     {{-- @dd($pageBanner) --}}
     <div class="breadcrumb-outer pt-10 pb-4">
         <div class="container">
             <div class="breadcrumb-content d-md-flex align-items-center pt-10">
                 <h2 class="mb-0">{{ $mainTitle ?? 'Our Package' }}</h2>
                 <nav aria-label="breadcrumb">
                     <ul class="breadcrumb">
                         <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                         <li class="breadcrumb-item"><a href="{{ url('/packages') }}">{{ $pageName }}</a></li>

                     </ul>
                 </nav>
             </div>
         </div>
     </div>
     <div class="dot-overlay"></div>
 </section>
 <!-- BreadCrumb Ends -->
