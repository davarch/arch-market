<?php

declare(strict_types=1);

namespace App\Filters;

use Domain\Catalog\Concerns\Filters\Filterable;
use Domain\Catalog\Contracts\FilterContract;
use Domain\Product\Models\OptionValue;
use Illuminate\Contracts\Database\Eloquent\Builder;

final class OptionFilter implements FilterContract
{
    use Filterable;

    public function title(): string
    {
        return 'Опции';
    }

    public function key(): string
    {
        return 'options';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $q) {
            $q->whereHas('optionValues', function ($optionValuesQuery) {
                $optionValuesQuery->whereIn('option_values.id', $this->requestValue());
            });
        });
    }

    public function values(): array
    {
        return OptionValue::query()
            ->with('option')
            ->select('id', 'title', 'option_id')
            ->get()
            ->groupBy('option.title')
            ->toArray();
    }

    public function view(): string
    {
        return 'catalog.filters.options';
    }
}
