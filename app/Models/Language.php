<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function __toString()
    {
        return $this->code;
    }
}
