<?php

namespace Datakrama\Lapiuth\Test;

use Datakrama\Lapiuth\Test\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**  */
    public function apiTest()
    {
        Passport::actingAs(
            factory(User::class)->create()
        );
    
        $response = $this->get('/api/auth/user');
    
        $response->assertStatus(200);
    }
}
