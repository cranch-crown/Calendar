<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use \App\Schedule;
use \App\User;

/**
 * テストケース前後で行う共通処理を定義する
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * テスト用ログインユーザ
     */
    protected $testuser;

    /**
     * テストケースを実行前の処理。
     * テスト用ログインユーザを作成する。
     * ※ ログイン中の動作確認を行うテストが多いので、予め作成しておく
     */
    public function setUp() {
        parent::setUp();

        $this->testuser = new User;
        $this->testuser->name = 'testuser';
        $this->testuser->password = bcrypt('passw0rd');
        $this->testuser->email = 'test@test.com';

        $this->testuser->save();
    }

    /**
     * テストケースの実行後の処理
     * テスト用ログインユーザを（予定を削除した上で）削除する。
     */
    public function tearDown() {
        // テストユーザに紐づく予定を削除する
        Schedule::where('user_id', $this->testuser->id)->delete();

        // テストユーザを削除する
        $this->testuser->delete();
        $this->testuser = null;

        parent::tearDown();
    }
}
