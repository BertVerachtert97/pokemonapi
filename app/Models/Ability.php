<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    /**
     * The pokemons that belong to the ability.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_abilities');
    }
}
