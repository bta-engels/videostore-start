<?php

namespace Database\Seeders;

use Exception;
use Faker;
use App\Models\Todo;
use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    private $chunkSize = 1000;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = config('languages');
        Translation::truncate();
        DB::unprepared('ALTER TABLE `translations` AUTO_INCREMENT = 1');
        $class = Todo::class;
        $todos = Todo::all()->chunk($this->chunkSize);

        foreach ($todos as $chunk) {
            $data = [];
            foreach ($chunk as $todo) {
                foreach ($languages as $lang => $locale) {
                    $faker  = Faker\Factory::create($locale);
                    $text       =  $faker->text(50);
                    $content    = (json_encode(['text' => $text]));
                    $data[] = [
                        'translatable_id'   => $todo->id,
                        'translatable_type' => $class,
                        'language'          => $lang,
                        'content'           => $content,
                    ];
                }
            }
            try {
                Translation::insert($data);
            } catch(Exception $e) {
                die($e->getMessage());
            }
        }
    }
}
