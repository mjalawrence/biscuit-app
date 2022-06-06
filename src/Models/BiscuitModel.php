<?php

namespace App\Models;

use App\Controllers\DataImporterController;
use PDO;

class BiscuitModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function deleteAllBiscuits():  void
    {
        $query = $this->db->prepare('DELETE FROM `biscuits`;');
        $query->execute();
    }

    public function addBiscuit(array $biscuit): void
    {
        $query = $this->db->prepare("INSERT INTO `biscuits` (`name`,`img`,`RDT`,`desc`,`wikipedia`)
                                            VALUES (:name,:img,:RDT,:desc,:wikipedia);");

        $query->execute($biscuit);
    }

    public function getBiscuit(): array
    {
        $query = $this->db->prepare('SELECT * FROM `biscuit_data`');
        $query->setFetchMode(PDO::FETCH_CLASS,BiscuitView::class);
        $query->execute();
        return $query->fetchAll();
    }
}
