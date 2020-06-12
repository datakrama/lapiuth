<?php

namespace Datakrama\Lapiuth\Test;

use Datakrama\Lapiuth\Test\Model\User;
use Datakrama\Lapiuth\Test\Model\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function databaseTest()
    {
        $this->assertEquals([
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
        ], \Schema::getColumnListing('users'));

        $this->assertEquals([
            'email',
            'token',
            'created_at',
        ], \Schema::getColumnListing('password_resets'));
    }
}
