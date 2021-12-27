<?php

namespace Tests\Feature\apps\TimeTracker;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_task()
    {
        $response = $this->get('/tasks-list');

        $response->assertStatus(200);
        $response->assertSee('Listado de tareas');
        $response->assertSee('homepage development');
    }
}
