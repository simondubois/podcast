<?php

namespace App\Providers;

use App\Collections\EpisodeCollection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EpisodeCollection::class, function () {
            return with(new EpisodeCollection())->fromPath(
                env('PODCAST_ROOT'),
                new CarbonPeriod(
                    Carbon::createFromTimestamp(env('PODCAST_START')),
                    env('PODCAST_FREQUENCY') . ' ' . env('PODCAST_INTERVAL'),
                    Carbon::now()
                )
            );
        });
    }
}
