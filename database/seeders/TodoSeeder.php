<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    private $count = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::truncate();
        DB::unprepared('ALTER TABLE `todos` AUTO_INCREMENT = 1');
        Todo::factory()->count($this->count)->create();
    }
}
