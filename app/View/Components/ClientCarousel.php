<?php

namespace App\View\Components;

use App\Models\Client;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientCarousel extends Component
{
    public $clients;

    public function __construct()
    {
        // Fetch all clients from the database
        $this->clients = Client::where('status','Active')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.client-carousel');
    }
}
