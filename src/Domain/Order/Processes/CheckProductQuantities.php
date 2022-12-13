<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Closure;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;

final class CheckProductQuantities implements OrderProcessContract
{
    /**
     * @throws OrderProcessException
     */
    public function __invoke(Order $order, Closure $next)
    {
        foreach (cart()->items() as $item) {
            if ($item->product->quantity < $item->quantity) {
                throw new OrderProcessException('Не осталось товара');
            }
        }

        return $next($order);
    }
}
