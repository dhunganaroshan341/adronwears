<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShippingRequestService;
use Illuminate\Http\Request;

class ShippingRequestController extends Controller
{
    protected $service;

    public function __construct(ShippingRequestService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $requests = $this->service->getFilteredRequests($request);

        return view('Admin.pages.ShippingRequest.index', compact('requests'));
    }
}
