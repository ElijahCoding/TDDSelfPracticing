<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_an_owner()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test */
    public function it_belongs_to_a_thread()
    {
      $thread = create('App\Thread');
      $reply = create('App\Reply', ['thread_id' => $thread->id]);

      $this->assertInstanceOf('App\Thread', $reply->thread);
    }
}
