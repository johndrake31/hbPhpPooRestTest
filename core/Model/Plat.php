<?php

namespace Model;

use PDO;

class Plat extends Model
{

    protected $table = "plats";

    public $id, $name, $description, $price, $restaurant_id;





    /**
     * crée un nouvel exemple
     * 
     * @param string $propriete1
     * @param string $propriete2
     * @return void
     */

    public function insert(object $plat): void
    {

        $maRequete = $this->pdo->prepare("INSERT INTO plats (name, description, price, restaurant_id ) 
        VALUES (:name, :description, :price, :restaurant_id )");

        $maRequete->execute([
            'name' => $plat->name,
            'description' => $plat->description,
            'price' => $plat->price,
            'restaurant_id' => $plat->restaurant_id,
        ]);
    }

    /**
     * 
     * 
     */
    public function findAllByRestaurant($restaurant_id)
    {
        $maRequete =  $this->pdo->prepare("SELECT * FROM plats WHERE restaurant_id =:restaurant_id");
        $maRequete->execute(["restaurant_id" => $restaurant_id]);
        $items = $maRequete->fetchAll(PDO::FETCH_CLASS, \Model\Plat::class);
        return $items;
    }


    /**
     * 
     * modifie un exemple
     */
    public function update(string $propriete1, string $propriete2, int $id): void
    {



        $maRequete = $this->pdo->prepare("UPDATE gateaux 
        SET propriete1=:propriete1, propriete2 = :propriete2 
        WHERE id = :id");

        $maRequete->execute([
            'propriete1' => $propriete1,
            'propriete2' => $propriete2,
            'id' => $id


        ]);
    }

    public function findAuthor()
    {
        return  $this->find($this->user_id, \Model\User::class, "autreTable");
    }
}
