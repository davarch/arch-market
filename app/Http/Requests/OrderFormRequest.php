<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Domain\Order\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class OrderFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer.first_name' => 'required',
            'customer.last_name' => 'required',
            'customer.email' => 'required|email',
            'customer.phone' => ['required', new PhoneRule()],
            'customer.city' => 'sometimes',
            'customer.address' => 'sometimes',
            'create_account' => 'bool',
            'password' => $this->boolean('create_account')
                ? ['required', 'confirmed', Password::default()]
                : 'sometimes',
            'delivery_type_id' => 'required|exists:delivery_types,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ];
    }
}
