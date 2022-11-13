<?php

declare(strict_types=1);

namespace Domain\Catalog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

final class BrandQueryBuilder extends Builder
{
    public function popular(): BrandQueryBuilder
    {
        return $this->select(['id', 'title', 'slug', 'thumbnail'])
            ->where('is_popular', true)
            ->orderBy('sorting');
    }
}
