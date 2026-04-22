<?php

namespace Domain\Cart\Contracts;

interface CartRepositoryInterface
{
    public function get(): array;

    public function put(array $cart): void;

    public function clear(): void;
}
