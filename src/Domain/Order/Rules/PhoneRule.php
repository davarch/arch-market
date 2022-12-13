<?php

declare(strict_types=1);

namespace Domain\Order\Rules;

use Illuminate\Contracts\Validation\Rule;

final class PhoneRule implements Rule
{
    public function passes($attribute, mixed $value): bool
    {
        return is_numeric($value);
    }

    public function message(): string
    {
        return 'Введите телефон только цифры без знаков';
    }
}
