<?php

namespace App\Controller;

use App\Session;
use App\View;
use App\Models\Pet;

// a fgv-ek hívása: index.php-ban
class PetsController
{
    public function index(){
        $pet = new Pet();  // Pet class példánya
        return View::make('index', [
            'data' => $pet -> all(),       // Pet class fgv
            'sumP' => $pet -> sumP()       // Pet class fgv
        ]);
    }

    public function create(){
        return View::make('create');
    }

    public function store(){
        if (count($_POST) != 3){
            return View::make('create');
        }

        $newPet = [
            'type' => $_POST['type'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
        ];

        if ((new Pet()) -> insert($newPet)){   // Pet class fgv
            // sikeres létrehozás
            header('Location: /');
            exit();
        }
        else{
            // sikertelen létrehozás
            return View::make('create');
        }
    }

    public function show() {
        if (!isset($_GET["id"])){
            header('/');
            exit();
        }

        $id = $_GET['id'];
        $result = (new Pet()) -> find($id);  // Pet class fgv

        // ha nincs adott id-s kisállat, akkor vissza a főoldra
        if (!$result){  // $result == false
            header('/');
            exit();
        }
        //var_dump($result);
        return View::make('show', [
            'pet' => $result
        ]);
    }

    public function sell() {
        if (!isset($_GET["id"])){
            header('/');
            exit();
        }
        $id = $_GET['id'];

        // ha sikerült a fgv hívás..., és vissza a főold
        if ((new  Pet()) -> sell($id)){   // Pet class fgv
            header('Location: /');
            exit();
        }
        // ha nem sikerült, akkor vissza a detailsra
        header('Location: /details?id=' . $id);
        exit();
    }

    public function delete(){
        if (!isset($_GET["id"])){
            header('/');
            exit();
        }
        $id = $_GET['id'];

        // ha sikerült a fgv hívás..., és vissza a főold
        if ((new  Pet()) -> delete($id)){   // Pet class fgv
            // success message...
            header('Location: /');
            exit();
        }
        // ha nem sikerült, akkor vissza a detailsra
        header('Location: /details?id=' . $id);
        exit();
    }

    public function edit(){
        if (!isset($_GET["id"])){
            header('Location: /');
            exit();
        }
        $id = $_GET['id'];
        $result = (new Pet()) -> find($id);  // Pet class fgv

        if (!$result){  // $result == false
            header('/');
            exit();
        }

        return View::make('edit', [
            'pet' => $result
        ]);
    }

    public function update(){
        //var_dump($_POST);
        if (!isset($_POST['id'])){
            header('Location: /');
            exit();
        }
        if ((new  Pet()) -> update($_POST['id'], $_POST)){   // Pet class fgv
            header('Location: /');
            exit();
        }
        header('Location: /edit?id=' . $_POST['id']);
        exit();
    }
}