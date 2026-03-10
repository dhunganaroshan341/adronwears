 <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 mb-4">
     <!-- Add Package Button -->
     <div>
         <button class="btn btn-primary addTourPackageBtn">Add Package</button>
     </div>

     <!-- Filter Dropdowns -->
     <div class="d-flex flex-wrap gap-3 align-items-center">

         <!-- Filter by Country -->
         <div class="form-group mb-0">
             <label for="filterCountry" class="form-label mb-1 fw-bold">Filter by Country</label>
             <select class="form-select form-select-sm" id="filterCountry">
                 <option selected value="all">All</option>
                 @foreach ($countries as $country)
                     <option value="{{ $country->id }}">{{ $country->name }}</option>
                 @endforeach
             </select>
         </div>

         <!-- Filter by Type -->
         <div class="form-group mb-0">
             <label for="filterType" class="form-label mb-1 fw-bold">Filter by Type</label>
             <select class="form-select form-select-sm" id="filterType">
                 <option selected value="all">All</option>
                 <option value="tour">Tour</option>
                 <option value="trekking">Trekking</option>
                 <option value="other">Other</option>
             </select>
         </div>

         <!-- Filter by Head Package -->
         <div class="form-group mb-0">
             <label for="filterHeadPackage" class="form-label mb-1 fw-bold">Filter by Head Package</label>
             <select class="form-select form-select-sm" id="filterHeadPackage">
                 <option selected value="all">All</option>
                 @foreach ($parentPackages as $package)
                     <option value="{{ $package->id }}">{{ $package->title }}</option>
                 @endforeach
                 {{-- Dynamically add more options from backend --}}
             </select>
         </div>

     </div>
 </div>
