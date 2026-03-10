<?php

namespace App\View\Components;

use App\Models\TourPackage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopDeal extends Component
{
    public $topDeals;

    /**
     * Create a new component instance.
     */
   public function __construct()
{
    // ✅ Fetch all "top deal" tour packages that are Active
    // ✅ Eager load 'images' and 'country' relationships
    $this->topDeals = TourPackage::with('images', 'country')
        ->where('status', 'Active')
        ->where('top_deal', 1)
        ->get();
}


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->topDeals);
        return view('components.top-deal', [
            'topDeals' => $this->topDeals,
        ]);
    }
}
