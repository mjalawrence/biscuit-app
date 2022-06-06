<?php
declare(strict_types=1);

use App\Controllers\DataImporterController;
use Slim\App;


return function (App $app) {
    $container = $app->getContainer();

    $app->get('/import', DataImporterController::class);

//    $app->get('/pokemon', function ($request, $response, $args) use ($container) {
//        $renderer = $container->get('renderer');
//        $pokemon_model= $container->get('PokemonModel');
//        $pokemon = $pokemon_model->getPokemon();
//        return $renderer->render($response, "index.php", $pokemon);
//    });
//
//    $app->post('/api/pokemon', function ($request, $response, $args) use ($container) {
//	$pokemonModel = $container->get('PokemonModel');
//	$newPokemon = $request->getParsedBody();
//	$pokemonModel->createPokemon($newPokemon);
//	return $response->withStatus(200);
//    });
};



//6. Create a route that soft deletes (marks a deleted flag as 1) an item from the database
// - items should then no longer display on the previous display routes created.
// an example of the URL to achieve this should be /pokemon/33 where 33 represents a unique id

