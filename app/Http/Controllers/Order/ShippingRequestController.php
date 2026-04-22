<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Order\Services\ShippingRequestService;
use App\Domain\Order\Resolvers\OrderItemResolver as ResolversOrderItemResolver;
use App\Domain\Order\Support\WhatsappMessageBuilder;

class ShippingRequestController extends Controller
{
    public function store(
        Request $request,
        ShippingRequestService $shippingService,
        ResolversOrderItemResolver $resolver,
        WhatsappMessageBuilder $whatsapp
    ) {
        $data = $request->validate([
            'cart_id' => 'nullable|exists:carts,id',
            'product_id' => 'nullable|exists:products,id',
            'customer_name' => 'nullable|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'address_line' => 'required|string',
            'city' => 'required|string',
        ]);

        $items = $resolver->resolve($data);

        $shipping = $shippingService->create($data);

        $message = $whatsapp->buildMessage($shipping, $items);

        $url = $whatsapp->generateUrl($message);

        return response()->json([
            'success' => true,
            'whatsapp_url' => $url
        ]);
    }
}
