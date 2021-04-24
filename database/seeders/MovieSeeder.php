<?php
namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Database\Seeders\Data\MovieData;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::truncate();
        Movie::insert(MovieData::getData());
    }
}
