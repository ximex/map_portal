<?php

require_once('DB.php');

class DBLayers {
    private $db;
    private $pdo;


    function __construct() {
        $this->db = new DB();
        $this->pdo = $this->db->pdo;
    }

    function __destruct() {
        $this->db = null;
    }


    public function getLayersByMapId($mapid) {
        $statement = "SELECT * FROM `layers` WHERE `mapid`=:mapid";
        $stmt = $this->pdo->prepare($statement);
        $stmt->bindParam(':mapid', $mapid, PDO::PARAM_INT);
        try {
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            print($e->getMessage());
            return null;
        }
    }
}