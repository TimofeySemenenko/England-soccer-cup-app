<?php declare(strict_types=1);


namespace EnglandSoccerCup\Providers;

use Illuminate\Support\ServiceProvider;
use EnglandSoccerCup\Repositories\Divisions\DivisionsContract;
use EnglandSoccerCup\Repositories\Divisions\RepositoryDivisions;

/**
 * Class DivisionsRepositoryServiceProvider
 * @package EnglandSoccerCup\Providers
 */
class DivisionsRepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(
            DivisionsContract::class,
            RepositoryDivisions::class
        );
    }
}
