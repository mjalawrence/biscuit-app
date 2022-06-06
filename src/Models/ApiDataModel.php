<?php

namespace App\Models;

use PDO;
use App\Controllers\GetApiDataController;

class ApiDataModel
{
    private PDO $db;
    protected ApiData $apiData;

    public function __construct(\PDO $db, GetApiDataController $getApiDataController)
    {
        $this->db = $db;
        $this->apiData = $getApiDataController;
    }

    protected function createDatabaseTable()
    {
        $query = $this->db->prepare("SET NAMES utf8mb4;
                    DROP TABLE IF EXISTS `biscuits`;
                    CREATE TABLE `biscuits` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `name` varchar(100) DEFAULT NULL,
                      `img` varchar(1000) DEFAULT NULL,
                      `RDT` int(10) DEFAULT NULL,
                      `desc` varchar(1000) DEFAULT NULL,
                      `wikipedia` varchar(10000) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        $query->execute();
    }

    protected function populateBiscuits()
    {
        $biscuits = $this->apiData->getBiscuits();

        $deleteQuery = $this->db->prepare("DELETE FROM `biscuits`;");
        $deleteQuery->execute();

        foreach ($biscuits as $biscuit) {
            $query = $this->db->prepare("INSERT INTO `biscuits` (`name`,`img`,`RDT`,`desc`,`wikipedia`)
                                            VALUES (:NAME,:IMG,:RDT,:DESC,:WIKIPEDIA);");
            $query->execute($biscuit);
        }
    }

    public function populateDatabase()
    {
        $this->createDatabaseTable();
        $this->populateBiscuits();
    }

}

