<?php

namespace App\View\Components\Admin\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public function __construct(
        public $product = null,
        public $categories = [],
        public $brands = [],
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.products.form');
    }
}
