<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprite extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The pokemon of the sprite.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
