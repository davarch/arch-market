<?php

declare(strict_types=1);

namespace Domain\Order\Contracts;

use Closure;
use Domain\Order\Models\Order;

interface OrderProcessContract
{
    public function __invoke(Order $order, Closure $next);
}
