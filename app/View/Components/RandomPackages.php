<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TourPackage;

class RandomPackages extends Component
{
    public $packages;

    /**
     * Create a new component instance.
     */
public function __construct()
{
   $this->packages = TourPackage::select('id', 'title', 'slug', 'duration')
    ->with(['packageImages:id,tour_package_id,image_path']) // eager load images
    ->withCount(['batches', 'itineraries', 'bookings']) // get counts
    ->where('status', 'Active') // ✅ only active packages
    ->orderByDesc('batches_count')
    ->orderByDesc('itineraries_count')
    ->orderByDesc('bookings_count')
    ->take(15) // bigger pool
    ->get()
    ->take(8);


    // Find max bookings_count in this collection
    $maxBookingsCount = $this->packages->max('bookings_count');

    // Add most_booked attribute dynamically to each package
    $this->packages->transform(function ($package) use ($maxBookingsCount) {
        $package->most_booked = ($package->bookings_count == $maxBookingsCount);
        return $package;
    });
}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Pass the randomized packages collection to the view
        return view('components.random-packages', ['randomPackages' => $this->packages]);
    }
}
