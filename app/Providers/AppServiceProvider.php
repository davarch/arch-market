<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Vite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(! app()->isProduction());

        DB::whenQueryingForLongerThan(500, static function (Connection $connection) {
            logger()?->channel('telegram')->debug($connection->query()->toSql());
        });

        Vite::macro('image', fn ($asset) => $this->asset("resources/images/{$asset}"));

        app(Kernel::class)
            ->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(5),
                function () {
                    logger()?->channel('telegram')->debug(request()?->url());
                }
            );
    }
}
