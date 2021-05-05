<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoLang extends Model
{
    protected $table = 'todos_lang';

    public function test(){
        // aktuelle sprache ermittlen
        $lang = App::getLocale();
    }
}
