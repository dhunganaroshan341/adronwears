<?php

namespace App\View\Components;

use App\Models\OurCountry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavDestination extends Component
{
    public $favouriteDestinationsByCountry;

    public function __construct()
{
    // Define your custom order by slug (lowercase)
    $customOrder = ['nepal', 'india', 'tibet', 'bhutan'];

    // Fetch countries with favouritePackages and eager loading
    $countries = OurCountry::with(['favouritePackages' => function ($query) {
        $query->with(['images', 'country']);
    }])->get();

    // Filter countries which have favouritePackages
    $filteredCountries = $countries->filter(fn($country) => $country->favouritePackages->isNotEmpty());

    // Sort with Nepal first, then India, Tibet, Bhutan, and others after
    $this->favouriteDestinationsByCountry = $filteredCountries->sortBy(function ($country) use ($customOrder) {
        $slug = strtolower($country->slug);
        $index = array_search($slug, $customOrder);
        return $index === false ? 999 : $index;
    })->values(); // reset keys
}


    public function render(): View|Closure|string
    {
        return view('components.fav-destination', [
            'favouriteDestinationsByCountry' => $this->favouriteDestinationsByCountry,
        ]);
    }
}

