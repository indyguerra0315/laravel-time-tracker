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
        $response = $this->post('/tasks/2b6f4660-b71c-4abe-bae9-2bfe365a526c', ['endTime' => '2021-12-27 20:51:00']);

        $response->assertStatus(302);
        $redirectResponse = $this->followRedirects($response);
        $redirectResponse->assertSee('Listado de tareas');
        $redirectResponse->assertSee('homepage development');
    }
}
