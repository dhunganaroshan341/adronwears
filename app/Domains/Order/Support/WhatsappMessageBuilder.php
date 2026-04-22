<?php

namespace App\Domain\Order\Support;

use App\Models\ShippingRequest;

class WhatsappMessageBuilder
{
    protected string $phone = '97798XXXXXXXX'; // change this

    public function buildMessage(ShippingRequest $shipping, array $items): string
    {
        $message = "Hi, I want to order:\n\n";

        foreach ($items as $item) {
            $message .= "- {$item['name']} x {$item['qty']} (Rs. {$item['price']})\n";
        }

        $message .= "\nTotal: Rs. " . $this->calculateTotal($items);

        $message .= "\n\nName: {$shipping->customer_name}";
        $message .= "\nPhone: {$shipping->customer_phone}";
        $message .= "\nAddress: {$shipping->address_line}, {$shipping->city}";

        return $message;
    }

    public function generateUrl(string $message): string
    {
        return "https://wa.me/{$this->phone}?text=" . urlencode($message);
    }

    protected function calculateTotal(array $items): int
    {
        return collect($items)->sum(fn($item) => $item['qty'] * $item['price']);
    }
}
