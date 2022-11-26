<?php

namespace Domain\Product\Models;

use App\Jobs\ProductJsonProperties;
use Database\Factories\ProductFactory;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Collections\ProductCollection;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Casts\PriceCast;
use Support\Concerns\Models\HasSlug;
use Support\Concerns\Models\HasThumbnail;

/**
 * @method Collection popular()
 */
class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
        'price',
        'is_popular',
        'sorting',
        'brand_id',
        'json_properties',
    ];

    protected $casts = [
        'price' => PriceCast::class,
        'json_properties' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::created(static function (Product $product) {
            ProductJsonProperties::dispatch($product)
            ->delay(now()->addSeconds(10));
        });
    }

    public function thumbnailDir(): string
    {
        return 'products';
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class);
    }

    public function newCollection(array $models = []): ProductCollection
    {
        return new ProductCollection($models);
    }

    public function newEloquentBuilder($query): ProductQueryBuilder
    {
        return new ProductQueryBuilder($query);
    }

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
