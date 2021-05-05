<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

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
//        Todo::truncate();
        Todo::factory()->count($this->count)->create();
    }
}
