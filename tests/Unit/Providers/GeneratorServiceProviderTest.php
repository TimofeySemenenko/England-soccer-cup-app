<?php declare(strict_types=1);


namespace Tests\Unit\Providers;

use Mockery;
use PHPUnit\Framework\TestCase;
use EnglandSoccerCup\Providers\GeneratorServiceProvider;

/**
 * Class GeneratorServiceProviderTest
 * @package Tests\Unit\Providers
 */
class GeneratorServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testDivisionRepository()
    {
        $service = Mockery::mock(GeneratorServiceProvider::class);
        if (app()->instance(GeneratorServiceProvider::class, $service)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        unset($service);
    }
}
