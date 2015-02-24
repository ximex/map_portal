<?php

require_once('DB.php');

class DBMap {
    private $db;
    private $pdo;


    function __construct() {
        $this->db = new DB();
        $this->pdo = $this->db->pdo;
    }

    function __destruct() {
        $this->db = null;
    }


    public function getAllOwnMaps($id, $column='id') {
        $statement = "SELECT * FROM `maps` WHERE `author`=:id ORDER BY :column";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':column', $column, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function getAllActiveMaps($column='id') {
        $statement = "SELECT `maps`.*, `users`.username FROM `maps`  JOIN `users` ON `maps`.author = `users`.id WHERE `active`=true ORDER BY :column";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':column', $column, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function getBestMaps($count=3) {
        $statement = "SELECT * FROM `maps` WHERE `active`=true ORDER BY `requests` DESC LIMIT :count";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':count', $count, PDO::PARAM_INT);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function getMapById($id) {
        $statement = "SELECT `maps`.*, `users`.username FROM `maps` JOIN `users` ON `maps`.author = `users`.id WHERE `maps`.id=:id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }

    public function insertNewMap($map) {
        $statement = "INSERT INTO `maps` (`name`, `description`, `author`, `build`, `request`, `active`, `bounds`, `startpoint`) VALUES (:name, :description, :author, :build, :request, :active, :bounds, :startpoint)";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':name', $map->name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $map->description, PDO::PARAM_STR);
        $stmt->bindParam(':author', $map->author, PDO::PARAM_INT);
        $stmt->bindParam(':build', $map->build, PDO::PARAM_STR);
        $stmt->bindParam(':request', $map->requests, PDO::PARAM_INT);
        $stmt->bindParam(':active', $map->active, PDO::PARAM_BOOL);
        $stmt->bindParam(':bounds', $map->bounds, PDO::PARAM_STR);
        $stmt->bindParam(':startpoint', $map->startpoint, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function updateMap($map) {
        $statement = "UPDATE `maps` SET `name`=:name, `description`=:description, `author`=:author, `build`=:build, `requests`=:requests, `active`=:active, `bounds`=:bounds, `startpoint`=:startpoint WHERE `id`=:id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':name', $map->name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $map->description, PDO::PARAM_STR);
        $stmt->bindParam(':author', $map->author, PDO::PARAM_INT);
        $stmt->bindParam(':build', $map->build, PDO::PARAM_STR);
        $stmt->bindParam(':request', $map->requests, PDO::PARAM_INT);
        $stmt->bindParam(':active', $map->active, PDO::PARAM_BOOL);
        $stmt->bindParam(':bounds', $map->bounds, PDO::PARAM_STR);
        $stmt->bindParam(':startpoint', $map->startpoint, PDO::PARAM_STR);
        $stmt->bindParam(':id', $map->id, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function incrementRequests($id) {
        $statement = "UPDATE `maps` SET `requests`=`requests`+1 WHERE `id`=:id";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }
}