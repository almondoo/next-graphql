<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::create([
            'status' => '未対応'
        ]);
        TaskStatus::create([
            'status' => '処理中'
        ]);
        TaskStatus::create([
            'status' => '処理済み'
        ]);
        TaskStatus::create([
            'status' => '完了'
        ]);
    }
}
