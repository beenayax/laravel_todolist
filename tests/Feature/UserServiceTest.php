<?php

namespace Tests\Feature;

use App\Services\Impl\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
    private userService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("Benaya", "Tamelan"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("Admin", "Admin"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("Benaya", "Azareel"));
    }
}
