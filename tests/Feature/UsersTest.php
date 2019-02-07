<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

use App\User;

class UsersTest extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithDatabase;

    public function testCanSeeUserPage()
    {
        $user = factory(User::class)->create();

        $response = $this->get($user->username);
        $response->assertSee($user->username);
    }

    public function testCanLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function testCantFollow()
    {
        $user = factory(User::class)->create();
        $other = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post($other->username . '/follow');

        $this->assertDatabaseHas('followers', [
            'user_id' => $user->id,
            'followed_id' => $other->id
        ]);
    }
}
