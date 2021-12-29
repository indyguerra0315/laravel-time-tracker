<?php

namespace Tests\Feature\apps\TimeTracker;

use DateTime;
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
        $now = (new DateTime())->format('Y-m-d H:i:s');
        $response = $this->post('/tasks', [
            'id' => \Str::uuid()->toString(),
            'name' => 'homepage development',
            'startTime' => $now
        ]);

        $response->assertStatus(302);

        $redirect = $this->followRedirects($response);

        $redirect->assertSee('homepage development');
        $redirect->assertSee($now);
    }
}
