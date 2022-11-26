<?php

declare(strict_types=1);

namespace Domain\Product\Models;

use Database\Factories\OptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Option extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];

    protected static function newFactory(): OptionFactory
    {
        return OptionFactory::new();
    }
}
