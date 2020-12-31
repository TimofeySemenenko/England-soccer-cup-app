<?php declare(strict_types=1);


namespace EnglandSoccerCup\Providers;

use Illuminate\Support\ServiceProvider;
use EnglandSoccerCup\Services\Generator\ServiceGenerator;
use EnglandSoccerCup\Services\Generator\GeneratorInterface;

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
            GeneratorInterface::class,
            ServiceGenerator::class
        );
    }
}
