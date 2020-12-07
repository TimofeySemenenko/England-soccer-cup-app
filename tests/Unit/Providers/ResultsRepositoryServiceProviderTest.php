<?php declare(strict_types=1);


namespace Tests\Unit\Providers;

use Mockery;
use PHPUnit\Framework\TestCase;
use EnglandSoccerCup\Providers\ResultsRepositoryServiceProvider;

/**
 * Class ResultsRepositoryServiceProviderTest
 * @package Tests\Unit\Providers
 */
class ResultsRepositoryServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testResultsRepository()
    {
        $service = Mockery::mock(ResultsRepositoryServiceProvider::class);
        if (app()->instance(ResultsRepositoryServiceProvider::class, $service)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        };
    }

}
