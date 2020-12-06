<?php declare(strict_types=1);


namespace EnglandSoccerCup\Providers;

use Illuminate\Support\ServiceProvider;

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
            'EnglandSoccerCup\Repositories\Results\ResultsContract',
            'EnglandSoccerCup\Repositories\Results\RepositoryResults'
        );
    }
}
