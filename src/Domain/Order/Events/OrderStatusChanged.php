<?php

declare(strict_types=1);

namespace Domain\Order\Events;

use Domain\Order\Models\Order;
use Domain\Order\States\OrderState;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class OrderStatusChanged
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @param  Order  $order
     * @param  OrderState  $old
     * @param  OrderState  $current
     */
    public function __construct(
        public Order $order,
        public OrderState $old,
        public OrderState $current,
    ) {
    }
}
