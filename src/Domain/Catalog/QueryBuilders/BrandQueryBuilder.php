<?php

declare(strict_types=1);

namespace Domain\Catalog\QueryBuilders;

use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class BrandQueryBuilder extends Builder
{
    public function popular(): Collection|array
    {
        return Cache::rememberForever('popular_brands',
            fn () => $this->select(['id', 'title', 'slug', 'thumbnail'])
                ->where('is_popular', true)
                ->orderBy('sorting')
                ->limit(6)
                ->get()
        );
    }
}
