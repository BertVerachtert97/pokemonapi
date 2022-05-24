<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The moves that belong to the pokemon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function moves()
    {
        return $this->belongsToMany(Move::class, 'pokemon_moves');
    }

    /**
     * The abilities that belong to the pokemon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'pokemon_abilities')
            ->withPivot('slot', 'is_hidden');
    }

    /**
     * The types that belong to the pokemon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(Type::class, 'pokemon_types')
            ->withPivot('slot');
    }

    /**
     * The stats that belong to the pokemon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stats()
    {
        return $this->belongsToMany(Stat::class, 'pokemon_stats')
            ->withPivot('base_stat', 'effort');
    }
}
