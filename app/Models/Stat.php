<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The pokemons that belong to the stat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_stats');
    }
}
