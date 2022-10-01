<?php

namespace App\apps\User;



use App\apps\User\MVC\UserModel;
use App\apps\Util\AbstractMVC\AbstractDatabase;
use PDO;

class UserDatabase extends AbstractDatabase
{

    public function getTable(): string
    {
        return "users";
    }

    public function getModel(): string
    {
        return UserModel::class;
    }

    #Aus Datenbank abrufen
    function getUsers(){
        $model = $this->getModel();
        if (!empty( $this->pdo)){
            $users =  $this->pdo->prepare("SELECT * FROM `users`");
            $users->execute();
            $users->setFetchMode(PDO::FETCH_CLASS, $model);
            $usersdata = $users->fetchAll();
            return $usersdata;
        }
        return false;
    }


#Einträge in die Datenbank speichern
    function newUser($firstName, $lastName, $username, $email, $password){
        if (!empty( $this->pdo)){
            $stmt =  $this->pdo->prepare("INSERT INTO `users` (firstname, lastname ,username, mail, password)" .
                " VALUES (:firstname,:lastname,:username, :mail, :password)");
            $stmt->bindValue(":firstname", $firstName);
            $stmt->bindValue(":lastname", $lastName);
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":mail", $email);
            $stmt->bindValue(":password", $password);
            $stmt->execute();
        }
    }

    function newStayIn($userid, $identifier, $securitytoken){
        if (!empty( $this->pdo)){
            $stmt =  $this->pdo->prepare("INSERT INTO `securitytokens` (userid, identifier, securitytoken) VALUES (:userid, :identifier, :securitytoken)");
            $stmt->bindValue(":userid", $userid);
            $stmt->bindValue(":identifier", $identifier);
            $stmt->bindValue(":securitytoken", $securitytoken);
            var_dump($this->pdo);
            echo $userid . "<br>";
            echo $identifier . "<br>";
            echo $securitytoken . "<br>";
            $stmt->execute();
        }
    }


#Einträge aus Datenbank löschen
    function deleteUser($username){
        $username = "Otto";
        if (!empty( $this->pdo)){
            $statement =  $this->pdo->prepare("DELETE FROM `users` WHERE `username` = :username");
            $statement->execute([
                'username' => $username
            ]);
        }
    }


#Einträge aus Datenbank updaten
    function updatePassword(){
        $table = $this->getTable();
        if (!empty( $this->pdo)){
            $statement =  $this->pdo->prepare("UPDATE `users` SET `password` = :password WHERE `userid` = :userid");
            $statement->execute([
                'password' => "d3as50d",
                'userid' => 446
            ]);
        }
    }


}