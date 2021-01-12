<?php declare(strict_types=1);


namespace EnglandSoccerCup\Providers;

use Illuminate\Support\ServiceProvider;
use EnglandSoccerCup\Repositories\Results\ResultsContract;
use EnglandSoccerCup\Repositories\Results\RepositoryResults;

/**
 * Class ResultsRepositoryServiceProvider
 * @package EnglandSoccerCup\Providers
 */
class ResultsRepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(
            ResultsContract::class,
            RepositoryResults::class
        );
    }
}
