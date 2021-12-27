<?php

namespace Tests\Feature\apps\TimeTracker;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_task_web()
    {
        $response = $this->post('/tasks', [
            'name' => 'homepage development',
            'startTime' => '2021-12-26 21:25:00'
        ]);

        $response->assertStatus(200);

        $response->assertSee('homepage development');
        $response->assertSee('2021-12-26 21:25:00');
    }
}
