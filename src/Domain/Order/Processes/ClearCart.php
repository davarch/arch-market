<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Closure;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class ClearCart implements OrderProcessContract
{
    public function __invoke(Order $order, Closure $next)
    {
        cart()->truncate();

        return $next($order);
    }
}
