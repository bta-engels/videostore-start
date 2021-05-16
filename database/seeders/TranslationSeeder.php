<?php

namespace Database\Seeders;

use Faker;
use App\Models\Todo;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array_keys(config('languages'));
        Translation::truncate();
        DB::unprepared('ALTER TABLE `translations` AUTO_INCREMENT = 1');

        Todo::all()->each(function (Todo $item) use ($languages) {
            foreach ($languages as $lang) {
                $locale = $lang . '_' . strtoupper($lang);
                $faker = Faker\Factory::create($locale);
                $text =  $faker->text(50);
                Translation::storeTranslations($item, ['text' => $text], $lang);
            }
        });
    }
}
