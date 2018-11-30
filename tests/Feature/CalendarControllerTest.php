<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

/**
 * CalendarControllerのテスト
 */
class CalendarControllerTest extends TestCase
{
    /**
     * CalendarController->index() のテスト
     * ログインしていないときは welcome を表示することを確かめる
     *
     * @return void
     */
    public function testIndexNotRedirectWhenNotLoggedIn()
    {   
        // '/' にアクセスする
        $response = $this->get('/');

        // ログインしていないことを確かめる
        $this->assertFalse(Auth::check());

        // index ビューが表示されていることを確かめる
        $response->assertViewIs('welcome');
    }

    /**
     * CalendarController->index() のテスト
     * ログインしているときは、スケジュール表示画面にリダイレクトされることを確かめる
     */
    public function testRedirectWhenLoggedIn() 
    {
        // testuser でログインした状態で '/' にアクセスする
        $response = $this->actingAs($this->testuser)->get('/');

        // ログインしていることを確かめる
        $this->assertTrue(Auth::check());

        // スケジュール表示画面にリダイレクトされることを確かめる
        // 未実装
    }
}
