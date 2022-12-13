<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Closure;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class AssignProducts implements OrderProcessContract
{
    public function __invoke(Order $order, Closure $next)
    {
        $order->orderItems()
            ->createMany(
                cart()->items()
                    ->map(function ($item) {
                        return [
                            'product_id' => $item->product_id,
                            'price' => $item->price,
                            'quantity' => $item->quantity,
                        ];
                    })
                    ->toArray()
            );

        return $next($order);
    }
}
