<?php

declare(strict_types=1);

namespace Domain\Catalog\Contracts;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Stringable;

interface FilterContract extends Stringable
{
    /**
     * @param  Builder  $query
     * @param  Closure  $next
     * @return void
     */
    public function __invoke(Builder $query, Closure $next): mixed;

    /**
     * @return string
     */
    public function title(): string;

    /**
     * @return string
     */
    public function key(): string;

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function apply(Builder $query): Builder;

    /**
     * @return array
     */
    public function values(): array;

    /**
     * @return string
     */
    public function view(): string;

    /**
     * @param  string|null  $index
     * @param  mixed|null  $default
     * @return mixed
     */
    public function requestValue(string $index = null, mixed $default = null): mixed;

    /**
     * @param  string|null  $index
     * @return string
     */
    public function name(string $index = null): string;

    /**
     * @param  string|null  $index
     * @return string
     */
    public function id(string $index = null): string;
}
