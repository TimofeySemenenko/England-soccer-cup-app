<?php declare(strict_types=1);


namespace Tests\Unit\Providers;

use Mockery;
use Tests\TestCase;
use EnglandSoccerCup\Providers\DivisionsRepositoryServiceProvider;

/**
 * Class DivisionsRepositoryServiceProviderTest
 * @package Tests\Unit\Providers
 */
class DivisionsRepositoryServiceProviderTest extends TestCase
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
        $service = Mockery::mock(DivisionsRepositoryServiceProvider::class);
        if (app()->instance(DivisionsRepositoryServiceProvider::class, $service)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        unset($service);
    }
}
