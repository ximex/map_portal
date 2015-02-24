<?php

require_once('DB.php');

class DBUser {
    private $db;
    private $pdo;


    function __construct() {
        $this->db = new DB();
        $this->pdo = $this->db->pdo;
    }

    function __destruct() {
        $this->db = null;
    }


    /*public function getAllUsers($column='id') {
        $statement = "SELECT * FROM `users` ORDER BY :column";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':column', $column, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }*/

    public function getUserBySessionId($sessionId) {
        $statement = "SELECT * FROM `users` WHERE `session`=:sessionId";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function getPasswordByUser($user) {
        $statement = "SELECT `password` FROM `users` WHERE `email`=:user || `username`=:user";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function getPasswordBySessionId($sessionId) {
        $statement = "SELECT `password` FROM `users` WHERE `session`=:sessionId";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function checkIfEmailExists($email) {
        $statement = "SELECT COUNT(*) FROM `users` WHERE `email`=:email";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function checkIfUsernameExists($username) {
        $statement = "SELECT COUNT(*) FROM `users` WHERE `username`=:username";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function insertNewUser($user, $password) {
        $statement = "INSERT INTO `users` (`email`, `username`, `password`, `first_name`, `last_name`, `address`, `birthday`) VALUES (:email, :username, :password, :first_name, :last_name, :address, :birthday)";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':first_name', $user->first_name);
        $stmt->bindParam(':last_name', $user->last_name);
        $stmt->bindParam(':address', $user->address);
        $stmt->bindParam(':birthday', $user->birthday);
        $stmt->bindParam(':password', $password);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function updateUser($sessionId, $user) {
        $statement = "UPDATE `users` SET `first_name`=:first_name, `last_name`=:last_name, `address`=:address, `birthday`=:birthday WHERE `session`=:sessionId";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $user->first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $user->last_name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $user->address, PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $user->birthday, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function updatePassword($sessionId, $password) {
        $statement = "UPDATE `users` SET `password`=:password WHERE `session`=:sessionId";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function setSession($user, $sessionId) {
        $statement = "UPDATE `users` SET `session`=:sessionId WHERE `email`=:user || `username`=:user";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function updateSession($oldSession, $sessionId) {
        $statement = "UPDATE `users` SET `session`=:sessionId WHERE `session`=:oldSession";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':oldSession', $oldSession, PDO::PARAM_STR);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deleteSession($sessionId) {
        $statement = "UPDATE `users` SET `session`=null WHERE `session`=:sessionId";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }
}