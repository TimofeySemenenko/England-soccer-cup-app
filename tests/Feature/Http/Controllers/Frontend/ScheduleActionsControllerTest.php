<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Frontend;

use Tests\TestCase;

class ScheduleActionsControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testGeneratePlayOff()
    {
        $result = $this->call(
            'GET',
            '/results/playoff'
        );

        if ($result->assertOk()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     * @return void
     */
    public function testGenerateGroup()
    {
        $result = $this->call(
            'GET',
            '/results/group'
        );

        if ($result->assertOk()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

}
