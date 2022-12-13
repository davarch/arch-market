<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Closure;
use DB;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class DecreaseProductsQuantities implements OrderProcessContract
{
    public function __invoke(Order $order, Closure $next)
    {
        foreach (cart()->items() as $item) {
            $item->product()->update([
                'quantity' => DB::raw('quantity - '.$item->quantity),
            ]);
        }

        return $next($order);
    }
}
