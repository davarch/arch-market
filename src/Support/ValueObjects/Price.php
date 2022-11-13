<?php

declare(strict_types=1);

namespace Support\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Support\Concerns\Makeable;

final class Price implements Stringable
{
    use Makeable;

    /**
     * @var array<string, string>
     */
    private array $currencies = [
        'RUB' => '₽',
    ];

    /**
     * @param  int  $value
     * @param  string  $currency
     * @param  int  $precision
     */
    public function __construct(
        private readonly int $value,
        private readonly string $currency = 'RUB',
        private readonly int $precision = 100
    ) {
        if ($this->value < 0) {
            throw new InvalidArgumentException('Price must be more than zero');
        }

        if (! isset($this->currencies[$this->currency])) {
            throw new InvalidArgumentException('Currency not allowed');
        }
    }

    /**
     * @return int
     */
    public function raw(): int
    {
        return $this->value;
    }

    /**
     * @return float|int
     */
    public function value(): float|int
    {
        return $this->value / $this->precision;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function symbol(): string
    {
        return $this->currencies[$this->currency];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return number_format(
            $this->value(), 2, ',', ' '
        ).' '.$this->symbol();
    }
}
