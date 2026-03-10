@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        @include('Admin.pages.TourPackage.buttons')



        <div class="table-responsive">
            <table class="table table-striped" id="data-album-show">

                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col">Action</th>
                        <th scope="col">Package</th>
                        <!-- <th scope="col">Head Package</th> -->
                        <!-- <th scope="col">Fav</th> -->
                        <th scope="col">Duration</th>
                        <th scope="col">Country</th>
                        <th scope="col">Top Deal</th>
                        <th scope="col">Fav Destination</th>
                        <th scope="col">Images</th>
                        <th scope="col">Itinerary</th>
                        <th scope="col">Batches</th>
                        <th scope="col">Package Includes</th>
                    </tr>
                </thead>


            </table>
        </div>
    </div>
    @include('Admin.pages.TourPackage.theTourPackageUploadModal') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.itineraryTableModal') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.tourBatchModal') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.tourBatchTable') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.itineraryModal') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.priceIncludesModal') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.priceIncludesTableModal') <!-- ✅ Modal here -->
    @include('Admin.pages.TourPackage.tourPackageModal') <!-- ✅ Modal here -->
@endsection
