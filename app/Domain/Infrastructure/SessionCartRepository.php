<?php

namespace Infrastructure\Cart;

use Domain\Cart\Contracts\CartRepositoryInterface;

class SessionCartRepository implements CartRepositoryInterface
{
    protected string $key = 'cart';

    public function get(): array
    {
        return session()->get($this->key, []);
    }

    public function put(array $cart): void
    {
        session()->put($this->key, $cart);
    }

    public function clear(): void
    {
        session()->forget($this->key);
    }
}
