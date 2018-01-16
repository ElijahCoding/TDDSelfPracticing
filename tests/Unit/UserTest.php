<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_many_threads()
    {
        $user = create('App\User');
        $thread = create('App\Thread', ['user_id' => $user->id]);

        $this->assertTrue($user->threads->contains($thread));
    }
}
