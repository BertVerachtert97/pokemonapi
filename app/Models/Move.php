<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the pokemons that belongs to the ability.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_moves');
    }
}
