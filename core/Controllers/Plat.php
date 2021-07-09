<?php

namespace Controllers;

class Plat extends Controller
{

    protected $modelName = \Model\Plat::class;

    public function supprApi()
    {
        $plat_id = null;

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $plat_id = $_POST['id'];
        }
        if (!$plat_id) {
            die('please enter a proper number  in the url for this to delete.');
        }


        $recipe_to_delete = $this->model->find($plat_id, $this->modelName);

        if (!$recipe_to_delete) {
            die("Does Not Exist");
        }
        // sleep(3000);
        $this->model->delete($plat_id);

        header("set Access-Control-Allow-Origin *");
        echo json_encode("delete successful");
    }

    public function createApi()
    {
        $name = null;
        $price = null;
        $description = null;
        $restaurant_id = null;

        if (!empty($_POST['name']) && $_POST['name'] != "") {
            $name = $_POST['name'];
        }
        if (!empty($_POST['restaurant_id']) && ctype_digit($_POST['restaurant_id'])) {
            $restaurant_id = $_POST['restaurant_id'];
        }
        if (!empty($_POST['description'])) {
            $description = htmlspecialchars($_POST['description']);
        }
        if (!empty($_POST['price'])) {
            $price = htmlspecialchars($_POST['price']);
        }
        if (!$name || !$description || !$price || !$restaurant_id) {
            die("formulaire mal rempli");
        }

        $newPlat = new $this->model();
        $newPlat->name = $name;
        $newPlat->price = $price;
        $newPlat->description = $description;
        $newPlat->restaurant_id = $restaurant_id;

        $this->model->insert($newPlat);

        header("set Access-Control-Allow-Origin *");
        echo json_encode("add successful");
    }
}
