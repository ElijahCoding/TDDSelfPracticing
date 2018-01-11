<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
      parent::setUp();

      $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_browse_threads()
    {

        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_browse_a_single_thread()
    {
      $this->get('/threads' . $this->thread)
          ->assertSee($this->thread->title);
    }
}
