<?php

declare(strict_types=1);

namespace Domain\Catalog\Filters;

use Domain\Catalog\Contracts\FilterContract;

final class FilterManager
{
    /**
     * @param  FilterContract[]  $items
     */
    public function __construct(
        protected array $items = []
    ) {
    }

    /**
     * @return array
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * @param  FilterContract[]  $items
     */
    public function registerFilters(array $items): void
    {
        $this->items = $items;
    }
}
