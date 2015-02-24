<?php

require_once('DBUser.php');

class User {
    public $email;
    public $username;
    public $first_name;
    public $last_name;
    public $address;
    public $birthday;

    function __construct($email, $username, $first_name, $last_name, $address, $birthday) {
        $this->email = $email;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->birthday = $birthday;
    }

    public function checkRequired() {
        $valid = true;

        if (strlen($this->email) < 6 || strlen($this->email) > 64) {
            $valid = false;
            print_r('cR1');
        }
        if (strlen($this->username) < 2 || strlen($this->username) > 32) {
            $valid = false;
            print_r('cR2');
        }

        return $valid;
    }

    public function checkIfExisting() {
        $valid = true;

        $dbUser = new DBUser();
        if ($dbUser->checkIfEmailExists($this->email)[0] > 0) {
            $valid = false;
            print_r('cE1');
        }
        if ($dbUser->checkIfUsernameExists($this->username)[0] > 0) {
            $valid = false;
            print_r('cE2');
        }
        $dbUser = null;

        return $valid;
    }

    public function checkPassword($password, $password2) {
        $valid = true;

        if (strlen($password) < 8 || $password !== $password2) {
            $valid = false;
            print_r('cP');
        }
        return $valid;
    }

    public function checkOptional() {
        $valid = true;

        if (!($this->first_name === '' || strlen($this->first_name) >= 2 & strlen($this->first_name) <= 24)) {
            $valid = false;
            print_r('cO1');
        }
        if (!($this->last_name === '' || strlen($this->last_name) >= 2 && strlen($this->last_name) <= 24)) {
            $valid = false;
            print_r('cO2');
        }
        if (!($this->address === '' || strlen($this->address) >= 4 && strlen($this->address) <= 128)) {
            $valid = false;
            print_r('cO3');
        }
        if (!($this->birthday === '' || strlen($this->first_name) === 10)) {
            $valid = false;
            print_r('cO4');
        }

        return $valid;
    }
}