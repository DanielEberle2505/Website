<?php

namespace App\User;

use App\Core\AbstractRepository;
use PDO;

//Klasse, die, die Datenbankabfragenbeinhaltet
class UsersRepository extends AbstractRepository {
    /**
     * Getter für den Tabellenamen
     */
    public function getTableName() {
        return "users";
    }

    /**
     * Getter für den Modelnamen
     */
    public function getModelName() {
        return "App\\User\\UserModel";
    }

    /**
     *Funktion die, die Datenbankabrfage enthält, die sich um das einfügen eines "Users" kümmert.
     * benötigt einen Namen und das password (beides als String übergeben)
     */
    public function addUser($pname, $ppassword) {
        $table = $this->getTableName();
        $model = $this->getModelName();
        $pass = password_hash($ppassword, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO `$table` (`name`,`password`,`userroleid`) VALUES (:name,:password,2)");
        $stmt->execute(['name' => $pname, 'password' => $pass]);
    }

    /**
     * Funktion, die, die Datenbankabfrage enthält, die einen Bestimmten "User" anhand seines Namens finden soll
     * benötigt den Namen (als String übergeben)
     */
    public function findByName($name) {

        $table = $this->getTableName();
        $model = $this->getModelName();
        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $object = $stmt->fetch(PDO::FETCH_CLASS);

        return $object;
    }

    public function updatePassword($newPassword, $name) {

        $table = $this->getTableName();
        $pass=password_hash($newPassword,PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE `$table` set password=:password where name=:name");
        $stmt->execute(['password'=>$newPassword, 'name' => $name]);
    }
    public function updateRole($role, $name) {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("UPDATE `$table` set userroleid=:role where name=:name");
        $stmt->execute(['role'=>$role, 'name' => $name]);
    }

}
