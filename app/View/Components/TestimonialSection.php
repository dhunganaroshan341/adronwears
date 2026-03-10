<?php

namespace App\View\Components;

use App\Models\Testimonial;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestimonialSection extends Component
{
    public $testimonials;

    public function __construct()
    {
        $this->testimonials = Testimonial::latest()->take(10)->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.testimonial-section');
    }
}
