<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
      parent::setUp();

      $this->thread = create('App\Thread');

    }

    /** @test */
    public function a_thread_can_make_a_string_path()
    {
      $thread = create('App\Thread');

      $this->assertEquals('/threads/' . $thread->channel->slug . '/' . $thread->id, $thread->path());
    }

    /** @test */
    public function it_has_many_replies()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->assertTrue($this->thread->replies->contains($reply));
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
      $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
      $this->thread->addReply([
        'body' => 'Foobar',
        'user_id' => 1
      ]);

      $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
      $thread = create('App\Thread');

      $this->assertInstanceOf('App\Channel', $thread->channel);
    }
}
