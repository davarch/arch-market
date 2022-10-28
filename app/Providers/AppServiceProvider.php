<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Password::defaults(static function () {
            return Password::min(12)
                ->uncompromised()
                ->mixedCase()
                ->symbols()
                ->numbers()
                ->letters();
        });

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
