<?php


namespace App\Factories\Models;

use Psr\Container\ContainerInterface;
use App\Models\BiscuitModel;

class BiscuitModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get('dbConnection');
        return new BiscuitModel($db);
    }
}
