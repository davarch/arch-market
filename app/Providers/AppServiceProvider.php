<?php

namespace App\Providers;

use App\Faker\Provider\FakerImageProvider;
use App\Http\Kernel;
use Carbon\CarbonInterval;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Vite;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));

            return $faker;
//            return tap(Factory::create(), function ($faker) {
//                $faker->addProvider(new FakerImageProvider($faker));
//            });
        });
    }

    public function boot(): void
    {
        Vite::macro('image', fn ($asset) => $this->asset("resources/images/{$asset}"));

        Model::shouldBeStrict(! app()->isProduction());

        if (app()->isProduction()) {
            DB::listen(static function ($query) {
                if ($query->time > 100) {
                    logger()?->channel('telegram')->debug($query->sql, $query->bindings);
                }
            });

            app(Kernel::class)
                ->whenRequestLifecycleIsLongerThan(
                    CarbonInterval::seconds(5),
                    static fn () => logger()?->channel('telegram')
                        ->debug('whenRequestLifecycleIsLongerThan: '.request()?->url())
                );
        }
    }
}
