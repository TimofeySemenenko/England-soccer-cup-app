<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Frontend;

use Tests\TestCase;

class ClearActionsTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testTruncate()
    {
        $result = $this->call(
            'GET',
            '/results/truncate'
        );

        if ($result->assertOk()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
}
