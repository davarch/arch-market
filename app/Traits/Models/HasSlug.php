<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(static function (Model $model) {
            $model->slug = self::generateSlug($model->slug ?? str($model->{self::slugFrom()})->slug());
        });
    }

    public static function generateSlug(string $slug): string
    {
        if (static::query()->firstWhere('slug', $slug)) {
            return self::generateSlug($slug.'_1');
        }

        return $slug;
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
