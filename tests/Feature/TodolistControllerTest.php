<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "username" => "Benaya",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Budi"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Budi");
    }

    public function testTodoField()
    {
        $this->withSession([
            "username" => "Benaya",
        ])->post('/todolist', [])
            ->assertSeeText("Todolist tidak boleh kosong");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "username" => "Benaya",
        ])->post('/todolist', [
            "todo" => "Naya"
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "username" => "Benaya",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Budi"
                ]
            ]
        ])->post('/todolist/1/delete')
        ->assertRedirect('/todolist');
    }
}
