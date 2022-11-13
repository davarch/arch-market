<?php

declare(strict_types=1);

namespace Domain\Catalog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

final class CategoryQueryBuilder extends Builder
{
    public function popular(): CategoryQueryBuilder
    {
        return $this->select(['id', 'title', 'slug'])
            ->where('is_popular', true)
            ->orderBy('sorting');
    }
}
