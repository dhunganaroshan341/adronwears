<?php

namespace App\Services;


use App\Models\TourPackage;

class BookingService
{
    protected $package;

    public function __construct(TourPackage $package)
    {
        $this->package = $package;
        // $this->updateTotalDuration();
    }

    // public function priceCalculator()
    // {


    // }
}
