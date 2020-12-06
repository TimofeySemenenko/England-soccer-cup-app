<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Frontend;

use Tests\TestCase;

class EnglandSoccerCupActionsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $result = $this->call(
            'GET',
            '/'
        );

        if ($result->assertOk()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

}
