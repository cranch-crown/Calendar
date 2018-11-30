<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * AddScheduleControllerのテスト
 */
class AddScheduleControllerTest extends TestCase
{
    /**
     * AddScheduleController->newschedule のテスト
     */
    public function testNewschedule() {
        // テスト用ユーザでログインし、'makeschedule/month/1000' にアクセスする
        // (現在時刻1000の状態で「予定を追加」ボタンを押下する)
        $response = $this->actingAs($this->testuser)->get('makeschedule/month/1000');
    
        // schedule_editor ビューが表示されていることを確かめる
        $response->assertViewIs('schedule_editor');

        // schedule_edior に正しい値が渡されていることを確かめる
        $response->assertViewHas('value_start_date');
        $response->assertViewHas('value_start_time');
        $response->assertViewHas('value_end_date');
        $response->assertViewHas('value_end_time');
    }
}
