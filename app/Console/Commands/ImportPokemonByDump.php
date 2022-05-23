<?php

namespace App\Console\Commands;

use App\Helpers\PokeapiSingularImportHelper;
use Illuminate\Console\Command;

class ImportPokemonByDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pokemon:import-dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports pokemons by dump';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!file_exists(public_path() . '/pokemons.json')) {
            $this->error('Could not find file in ' . public_path() . ' with the name pokemons.json');
            return 0;
        }

        ini_set('memory_limit', -1);
        $pokemons = json_decode(file_get_contents(public_path() . '/pokemons.json'), true);
        $importHelper = new PokeapiSingularImportHelper();

        $bar = $this->output->createProgressBar(count($pokemons));

        foreach ($pokemons as $pokemon) {
            $name = $importHelper->importPokemon($pokemon);

            $bar->advance();
        }

        $bar->finish();
        $this->info('Import has been successful');

        return 0;
    }
}
