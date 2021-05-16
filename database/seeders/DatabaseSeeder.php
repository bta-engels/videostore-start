<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        Schema::disableForeignKeyConstraints();
        $this->call([
//            UserSeeder::class,
//            AuthorSeeder::class,
//            MovieSeeder::class,
//            TodoSeeder::class,
            TranslationSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
