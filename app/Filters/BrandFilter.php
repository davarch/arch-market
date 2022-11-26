<?php

declare(strict_types=1);

namespace App\Filters;

use Domain\Catalog\Concerns\Filters\Filterable;
use Domain\Catalog\Contracts\FilterContract;
use Domain\Catalog\Models\Brand;
use Illuminate\Contracts\Database\Eloquent\Builder;

final class BrandFilter implements FilterContract
{
    use Filterable;

    public function title(): string
    {
        return 'Бренды';
    }

    public function key(): string
    {
        return 'brands';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $q) {
            $q->whereIn('brand_id', $this->requestValue());
        });
    }

    public function values(): array
    {
        return Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get()
            ->pluck('title', 'id')
            ->toArray();
    }

    public function view(): string
    {
        return 'catalog.filters.brands';
    }
}