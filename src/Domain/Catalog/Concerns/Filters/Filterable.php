<?php

declare(strict_types=1);

namespace Domain\Catalog\Concerns\Filters;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait Filterable
{
    public function __invoke(Builder $query, Closure $next): void
    {
        $this->apply($query);

        $next($query);
    }

    public function requestValue(string $index = null, mixed $default = null): mixed
    {
        return request('filters.'.$this->key().($index ? ".$index" : ''), $default);
    }

    public function name(string $index = null): string
    {
        return str($this->key())
            ->wrap('[', ']')
            ->prepend('filters')
            ->when($index, fn ($str) => $str->append("[$index]"))
            ->value();
    }

    public function id(string $index = null): string
    {
        return str($this->name($index))
            ->slug('_')
            ->value();
    }

    public function __toString(): string
    {
        return view($this->view(), ['filter' => $this])->render();
    }
}
