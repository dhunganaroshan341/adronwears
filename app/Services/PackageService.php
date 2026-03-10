<?php

namespace App\Services;


use App\Models\TourPackage;

class PackageService
{
    protected $package;

    public function __construct(TourPackage $package)
    {
        $this->package = $package;
        // $this->updateTotalDuration();
    }

    public function updateTotalDuration()
    {
        $itineraryDuration = $this->package->itineraries->sum('day_number');
            $this->package->duration = $itineraryDuration;
            $this->package->save();

    }
}
