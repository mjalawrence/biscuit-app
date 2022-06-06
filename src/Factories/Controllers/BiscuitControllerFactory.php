<?php

namespace App\Factories\Controllers;

use Psr\Container\ContainerInterface;
use App\Controllers\BiscuitController;

class BiscuitControllerFactory
{
    public function __invoke(ContainerInterface $container): BiscuitController
    {
        $renderer = $container->get('renderer');
        return new BiscuitController($renderer);
    }
}
