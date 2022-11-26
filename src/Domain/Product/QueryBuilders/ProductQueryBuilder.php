<?php

declare(strict_types=1);

namespace Domain\Product\QueryBuilders;

use Cache;
use Domain\Catalog\Facades\Sorter;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pipeline\Pipeline;

final class ProductQueryBuilder extends Builder
{
    public function popular(): Collection|array
    {
        return Cache::rememberForever('popular_products',
            fn () => $this->where('is_popular', true)
                ->orderBy('sorting')
                ->limit(8)
                ->get()
        );
    }

    public function search(): ProductQueryBuilder
    {
        return $this->when(request('s'), function (Builder $query) {
            $query->whereFullText(['title', 'text'], request('s'));
        });
    }

    public function withCategory(?Category $category): ProductQueryBuilder
    {
        return $this->when($category?->id, function (Builder $query) use ($category) {
            $query->whereRelation(
                'categories',
                'categories.id',
                '=',
                $category->id
            );
        });
    }

    public function filtered(): ProductQueryBuilder
    {
        return app(Pipeline::class)
            ->send($this)
            ->through(filters())
            ->thenReturn();
    }

    public function sorted(): ProductQueryBuilder|Builder
    {
        return Sorter::run($this);
    }
}
