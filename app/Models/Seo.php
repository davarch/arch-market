<?php

namespace App\Models;

use App\Casts\SeoUrlCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Seo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
    ];

    protected $casts = [
        'url' => SeoUrlCast::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::created(static function (Seo $model) {
            Cache::forget('seo_'.str($model->url)->slug('_'));
        });

        static::updated(static function (Seo $model) {
            Cache::forget('seo_'.str($model->url)->slug('_'));
        });

        static::deleted(static function (Seo $model) {
            Cache::forget('seo_'.str($model->url)->slug('_'));
        });
    }
}
