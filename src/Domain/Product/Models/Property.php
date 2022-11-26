<?php

declare(strict_types=1);

namespace Domain\Product\Models;

use Database\Factories\PropertyFactory;
use Domain\Product\Collections\PropertyCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Property extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];

    public function newCollection(array $models = []): PropertyCollection
    {
        return new PropertyCollection($models);
    }

    protected static function newFactory(): PropertyFactory
    {
        return PropertyFactory::new();
    }
}
