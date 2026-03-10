<?php

namespace App\View\Components;

use App\Models\Client;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AssociatedClientCarousel extends Component
{
    public $clients;

    public function __construct()
    {
        // Fetch all clients from the database
        $this->clients = Client::where('status','Active')->where('status','associated')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.client-carousel');
    }
}
