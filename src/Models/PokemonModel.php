<?php

namespace App\Models;

class PokemonModel
{
    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getPokemon(): array
    {
        $query = $this->db->prepare('SELECT * FROM `pokemon-species-data`');
        $query->execute();
        return $query->fetchAll();
    }

    public function createPokemon(array $pokemon)
    {
        $query = $this->db->prepare(
            'INSERT INTO `pokemon-species-data` (`dex number`, `name`,`type1`,`type2`,`image-src`) 
                    VALUES (:dex, :name, :type1, :type2, :image);');
        $query->bindParam(':dex', $pokemon['dex']);
        $query->bindParam(':name', $pokemon['name']);
        $query->bindParam(':type1', $pokemon['type1']);
        $query->bindParam(':type2', $pokemon['type2']);
        $query->bindParam(':image', $pokemon['image-src']);
        $query->execute();
    }
}
