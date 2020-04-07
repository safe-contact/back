<?php

namespace Tests\Unit;

use App\Facades\UserFacade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUser()
    {
        $userCreated = UserFacade::create([
            'name' => 'Rudy',
            'last_name' => 'Zanotti',
            'email' => 'rudy.zanotti69@gmail.com',
            'deviceId' => '00:00:00:00:00'
        ]);

        $this->assertDatabaseHas('users', [
            'deviceId' => '00:00:00:00:00',
        ]);
    }
}
