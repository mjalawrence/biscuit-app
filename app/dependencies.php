<?php
declare(strict_types=1);

use App\Models\PokemonModel;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $container = [];

    $container[LoggerInterface::class] = function (ContainerInterface $c) {
        $settings = $c->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    };

    $container['renderer'] = function (ContainerInterface $c) {
        $settings = $c->get('settings')['renderer'];
        $renderer = new PhpRenderer($settings['template_path']);
        return $renderer;
    };

    $container['PDO'] = function (ContainerInterface $c) {
        $db = new PDO('mysql:host=127.0.0.1:3306; dbname=biscuit-database', 'root', 'password');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    };

    $container['BiscuitController'] = DI\factory('\App\Factories\Controllers\BiscuitController');

//    $container['BiscuitModel'] = DI\factory('\App\Factories\Models\BiscuitModelFactory');

//    $container['pdo'] = function (ContainerInterface $c) {
//        $db = new PDO ('mysql:host=127.0.0.1:3306; dbname=biscuit-database', 'root', 'password');
//        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//        return $db;
//    };

//    $container['PokemonModel'] = function (ContainerInterface $c) {
//        $db = $c->get('pdo');
//        $pokemonModel = new PokemonModel($db);
//        return $pokemonModel;
//    };



    $containerBuilder->addDefinitions($container);
};



//EXERCISE:
//create a new project using the slim skeleton
//using someone else’s collection db, make an app which has
//factory functions for PDO and for ThingModel (whatever thing they are collecting)
//ThingModel which should be in src
//a homepage route which displays all the Things (in plain text)
//a template for the homepage