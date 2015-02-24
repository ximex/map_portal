<?php

session_start();

require_once('csrf-magic.php');
require_once('DBUser.php');

class AuthenticationManager {
    public function login($user, $password) {
        $dbUser = new DBUser();
        $userPw = $dbUser->getPasswordByUser($user);
        $dbUser = null;

        if (password_verify($password, $userPw['password'])) {
            session_regenerate_id(true);
            $_SESSION['id'] = session_id();
            $dbUser = new DBUser();
            $dbUser->setSession($user, $_SESSION['id']);
            $dbUser = null;
            return true;
        } else {
            if ($this->isAuthenticated()) {
                session_unset();
                session_regenerate_id(true);
                $_SESSION['id'] = session_id();
            }
            return false;
        }
    }

    public function logout() {
        if ($this->isAuthenticated()) {
            $dbUser = new DBUser();
            $dbUser->deleteSession($_SESSION['id']);
            $dbUser = null;
            session_unset();
            session_regenerate_id(true);
        }
    }

    public function isAuthenticated() {
        return $_SESSION['id'] === session_id();
    }
}


$authM = new AuthenticationManager();
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $loginAllowed = $authM->login(htmlentities($_POST['user']), $_POST['password']);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    $authM->logout();
}
$signedIn = $authM->isAuthenticated();

//print_r($GLOBALS['csrf']);