<?php

declare(strict_types=1);

namespace Domain\Product\Models;

use Database\Factories\OptionValueFactory;
use Domain\Product\Collections\OptionValueCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class OptionValue extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'option_id',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function newCollection(array $models = []): OptionValueCollection
    {
        return new OptionValueCollection($models);
    }

    protected static function newFactory(): OptionValueFactory
    {
        return OptionValueFactory::new();
    }
}
