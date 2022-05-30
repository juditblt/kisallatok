<?php

namespace App\Models;

use App\DB;

// ebben a classban vannak a queryk
// a fgv-ek hívásai: PetsController-ben
class Pet
{
    private DB $db;
    private string $table = "pets";  // az adattábla neve

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    // lekérni az összes kisállatot, eladott és törölt kivételével:
    public function all(){
        $result = $this -> db ->query("SELECT * FROM " . $this ->table . " WHERE deleted_at IS NULL AND sold_at IS NULL");
        return $result ->fetchAll();
    }

    // eladott kisállatok ára összesítve:
    public function sumP(){
        $sum = $this -> db -> query("SELECT SUM(price) FROM " . $this ->table . " WHERE sold_at > 0");
        return $sum -> fetch();
    }

    // új kisállatot tenni az adatbázisba:
    public function insert(array $pet){
        $stmt = $this -> db ->prepare("INSERT INTO " . $this ->table .
            "(type, name, price, created_at) VALUE " .
            "(:type, :name, :price, :created_at)");

        $stmt -> bindValue(':type', $pet['type']);
        $stmt -> bindValue(':name',$pet['name']);
        $stmt -> bindValue(':price', $pet['price']);
        $stmt -> bindValue(':created_at', date("Y-m-d h:i:s"));

        return $stmt ->execute();
    }

    // adott id-jú kisállat adatai:
    public function find(int $id): false|array{
        $stmt = $this -> db -> prepare("SELECT * FROM " . $this -> table . " WHERE id = :id");
        $stmt -> bindValue(':id', $id);

        $stmt -> execute();

        if ($stmt ->rowCount() == 1){
            return $stmt -> fetch();
        }
        return false;
    }

    // eladás: sold_at értéket akt. dátumra állít:
    public function sell(int $id){
        $datetime = date("Y-m-d h:i:s");  // aktuális dátum
        $stmt = $this -> db ->prepare("UPDATE " . $this -> table . " SET sold_at = \"$datetime\" WHERE id = :id");
        $stmt -> bindValue(':id', $id);
        return $stmt -> execute();
    }

    // törlés: deleted_at értékének beállítása az aktuális dátumra:
    public function delete(int $id){
        $datetime = date("Y-m-d h:i:s");  // aktuális dátum
        $stmt = $this -> db ->prepare("UPDATE " . $this -> table . " SET deleted_at = \"$datetime\" WHERE id = :id");
        $stmt -> bindValue(':id', $id);
        return $stmt -> execute();
    }

    // szerkesztés
    public function update(int $id, array $pet) : bool{
        $stmt = $this -> db ->prepare("UPDATE " . $this -> table .
            " SET type = :type, name = :name, price = :price, updated_at = :updated_at WHERE id = :id");

        $stmt -> bindValue(':type', $pet['type']);
        $stmt -> bindValue(':name',$pet['name']);
        $stmt -> bindValue(':price', $pet['price']);
        $stmt -> bindValue(':updated_at', date("Y-m-d h:i:s"));
        $stmt -> bindValue(':id', $id);

        return $stmt -> execute();
    }
}