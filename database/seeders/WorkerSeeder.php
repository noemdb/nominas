<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        User::factory(30)->create()->each(function ($user) {
            Worker::factory()->create(['user_id' => $user->id]);
        });
    }
}
