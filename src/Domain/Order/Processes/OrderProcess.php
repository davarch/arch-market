<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Events\OrderCreated;
use Domain\Order\Models\Order;
use DomainException;
use Illuminate\Pipeline\Pipeline;
use Support\Transaction;
use Throwable;

final class OrderProcess
{
    protected array $processes = [];

    public function __construct(
        protected Order $order
    ) {
    }

    public function processes(array $processes): self
    {
        $this->processes = $processes;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function run(): Order
    {
        return Transaction::run(
            callback: function () {
                return app(Pipeline::class)
                    ->send($this->order)
                    ->through($this->processes)
                    ->thenReturn();
            },
            finished: static function (Order $order) {
                flash()->info("Заказ $order->id создан");

                event(new OrderCreated($order));
            },
            onError: static function (Throwable $throwable) {
                throw new DomainException($throwable->getMessage());
            }
        );
    }
}
