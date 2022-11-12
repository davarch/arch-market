<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
        'is_popular',
        'sorting',
    ];

    public function thumbnailDir(): string
    {
        return 'brands';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query
            ->where('is_popular', true)
            ->orderBy('sorting');
    }
}
