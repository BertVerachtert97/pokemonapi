<?php

namespace App\Console\Commands;

use App\Helpers\PokeapiSingularImportHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class ImportPokemonByIdOrName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pokemon:import-singular {pokemon}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports a singular pokemon based on name or id';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception|\GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $pokemon = $this->argument('pokemon');
        $baseUrl = 'https://pokeapi.co/api/v2/';
        $importHelper = new PokeapiSingularImportHelper();

        if (empty($pokemon)) {
            $pokemon = $this->ask('What pokemon id or name do you want to import?');
        }

        $guzzle = new Client(['verify' => false]);

        try {
            $response = $guzzle->get($baseUrl . 'pokemon/' . $pokemon);
            $pokemon = json_decode($response->getBody(), true);

            $name = $importHelper->importPokemon($pokemon);
        } catch (ClientException $exception) {
            $this->error($exception->getMessage());

            throw new \Exception($exception->getMessage());
        }

        $this->info('Succesfully import pokemon with name: ' . $name);

        return 0;
    }
}
