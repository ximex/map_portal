<?php

class DB {
    private $host = 'localhost'; //'rfmtc.no-ip.org';
    private $db = 'map_portal';
    private $username = 'map_portal';
    private $password = 'map_portal@fh';
    public $pdo;

    function __construct() {
        $this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function __destruct() {
        $this->pdo = null;
    }
}