<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreShippingRequest;
use App\Domain\Order\Services\ShippingRequestService;
use App\Domain\Order\Resolvers\OrderItemResolver;
use App\Domain\Order\Support\WhatsappMessageBuilder;

class ShippingRequestController extends Controller
{
    public function store(
        StoreShippingRequest $request,
        ShippingRequestService $shippingService,
        OrderItemResolver $resolver,
        WhatsappMessageBuilder $whatsapp
    ) {

        // DTO from Form Request
        $dto = $request->toDto();
        // Resolve order items
        // Create shipping request
        $shipping = $shippingService->create($dto);
        $items = $resolver->resolve($dto);

        // Build WhatsApp message
        $message = $whatsapp->buildMessage($shipping, $items);

        // Generate WhatsApp URL
        $url = $whatsapp->generateUrl($message);

        return response()->json([
            'success' => true,
            'whatsapp_url' => $url,
        ]);
    }
}
