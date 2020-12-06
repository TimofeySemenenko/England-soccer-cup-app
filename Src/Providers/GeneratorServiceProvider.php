<?php declare(strict_types=1);


namespace EnglandSoccerCup\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class GeneratorServiceProvider
 * @package EnglandSoccerCup\Providers
 */
class GeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(
            'EnglandSoccerCup\Services\Generator\GeneratorInterface',
            'EnglandSoccerCup\Services\Generator\ServiceGenerator'
        );
    }

}
