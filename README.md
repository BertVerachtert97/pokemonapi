# Pokemon api
 This project is for appwise.

## Setup
First make sure Docker is running.

Run ./vendor/bin/sail up -d

If this is your first time running it run ./vendor/bin/sail artisan migrate

## Commands
For importing a dump or seed of pokemons run ./vendor/bin/sail artisan pokemon:import-dump

For importing a singular pokemon run ./vendor/bin/sail artisan pokemon:import-singular {id or name}

## Swagger

For accessing Swagger go to http://localhost/api/documentation

Change the file in the explore input to http://localhost/docs/openapi.yaml

## Metrics

For accessing the metrics go to http://localhost/metrics


