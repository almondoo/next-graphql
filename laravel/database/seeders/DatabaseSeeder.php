<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Member;
use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\TaskStatus;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', 'example@example.com')->first()) {
            $this->call([
                UserSeeder::class,
            ]);
        }
        // task_statusesがない場合のみ行う
        if (!TaskStatus::first()) {
            $this->call(TaskStatusSeeder::class);
        }

        User::factory(10)->create();
        Task::factory(100)->create();
        TaskComment::factory(100)->create();
        Community::factory(3)->create();
        Member::factory(10)->create();
        Message::factory(100)->create();
    }
}
