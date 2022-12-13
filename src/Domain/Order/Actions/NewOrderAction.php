<?php

declare(strict_types=1);

namespace Domain\Order\Actions;

use App\Http\Requests\OrderFormRequest;
use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\DTO\RegisterUserDTO;
use Domain\Order\Models\Order;

final class NewOrderAction
{
    public function __construct(protected RegisterUserContract $registerUserAction)
    {
    }

    public function __invoke(OrderFormRequest $request): Order
    {
        $customer = $request->get('customer');

        if ($request->boolean('create_account')) {
            ($this->registerUserAction)(RegisterUserDTO::from([
                'name' => $customer['first_name'].' '.$customer['last_name'],
                'email' => $customer['email'],
                'password' => $request->get('password'),
            ]));
        }

        return Order::query()->create([
            'payment_method_id' => $request->get('payment_method_id'),
            'delivery_type_id' => $request->get('delivery_type_id'),
        ]);
    }
}
