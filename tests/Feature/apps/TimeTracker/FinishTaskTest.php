<?php

namespace Tests\Feature\apps\TimeTracker;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FinishTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_finish_task()
    {
        $response = $this->post('/tasks/0e74de42-c49b-46bf-2220-782a7aec55d8', ['endTime' => '2021-12-30 20:51:00']);

        $response->assertStatus(302);
        $redirectResponse = $this->followRedirects($response);
        $redirectResponse->assertSee('Listado de tareas');
        $redirectResponse->assertSee('test');
    }
}
