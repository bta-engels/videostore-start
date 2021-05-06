<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class TodoLang extends Model
{
    protected $table = 'todos_lang';

    public function test() {
        // aktuelle Sprache ermitteln
        $lang = App::getLocale();
    }
}
