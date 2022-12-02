<?php

declare(strict_types=1);

namespace Domain\Cart\Models;

use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use MassPrunable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'storage_id',
        'user_id',
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function prunable(): Cart
    {
        return static::where('created_at', '<=', now()->subDays(3));
    }
}
