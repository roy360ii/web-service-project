<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_all_users()
    {
        factory(User::class, 3)->create();

        $response = $this->get('/api/user');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }
}
