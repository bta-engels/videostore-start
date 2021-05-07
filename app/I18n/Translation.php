<?php
namespace App\I18n;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model {
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'object',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'language',
        'translatable_id',
        'translatable_type',
    ];

    /**
     * Get all of the owning translatable models.
     *
     * @return Builder
     */
    public function translatable()
    {
        return $this->morphTo();
    }
}
