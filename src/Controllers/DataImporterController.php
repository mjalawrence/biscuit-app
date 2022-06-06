<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\ApiDataModel;
use App\Models\BiscuitModel;
use App\Services\BiscuitApiService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DataImporterController extends Controller
{
    protected BiscuitApiService $service;
    protected BiscuitModel $model;

    public function __construct(BiscuitApiService $service, BiscuitModel $model)
    {
        $this->service = $service;
        $this->model = $model;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $biscuits = $this->service->fetchBiscuitData();

        $this->model->deleteAllBiscuits();

        foreach ($biscuits['biscuits'] as $biscuit) {
            $this->model->addBiscuit($biscuit);
        }

        return $response;

    }


//    protected $this->$biscuitApiData = $biscuitApiData;
//
//
//    public function databaseParty()
//    {
//        $biscuitApiData = new GetApiDataController();
//        $connectionToDb = $container['dbConnection'];
//        $databasePopulater = new ApiDataModel ($connectionToDb, $biscuitApiData);
//        $databasePopulater->populateDatabase();
//        return true;
//    } else {
//        return false;
//    }
}