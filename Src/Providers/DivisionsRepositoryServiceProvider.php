<?php declare(strict_types=1);


namespace EnglandSoccerCup\Providers;

use Illuminate\Support\ServiceProvider;

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
            'EnglandSoccerCup\Repositories\Divisions\DivisionsContract',
            'EnglandSoccerCup\Repositories\Divisions\RepositoryDivisions'
        );
    }
}
