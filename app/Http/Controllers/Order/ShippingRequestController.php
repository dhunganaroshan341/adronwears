<?php

namespace App\Http\Controllers\Order;

use App\Domain\Order\Resolvers\OrderItemResolver;
use App\Domain\Order\Services\ShippingRequestService;
use App\Domain\Order\Support\WhatsappMessageBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreShippingRequest;

class ShippingRequestController extends Controller
{
    public function store(
        StoreShippingRequest $request,
        ShippingRequestService $shippingService,
        OrderItemResolver $resolver,
        WhatsappMessageBuilder $whatsapp
    ) {
        $data = $request->validated();

        $shipping = $shippingService->create($data);

        $items = $resolver->resolve($data);

        $message = $whatsapp->buildMessage(
            $shipping,
            $items
        );

        $url = $whatsapp->generateUrl($message);

        return response()->json([
            'success' => true,
            'whatsapp_url' => $url,
        ]);
    }
}
