<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            'username' => 'Benaya'
        ])->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "username" => "Benaya",
            "password" => "Tamelan"
        ])->assertRedirect("/")
            ->assertSessionHas("username", "Benaya");
    }

    public function testLoginForUserAllreadyLogin()
    {
        $this->withSession([
            'username' => 'Benaya'
        ])->post('/login', [
            "username" => "Benaya",
            "password" => "Tamelan"
        ])->assertRedirect("/");
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText("Username or Password is required");
    }

    public function testLoginFail()
    {
        $this->post('/login', [
            "username" => "Benaya",
            "password" => "Azareel"
        ])->assertSeeText("Username or Password is wrong");
    }

    public function testLogout()
    {
        $this->withSession(["username" => "Benaya"
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("username");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/");
    }
}
