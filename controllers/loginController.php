<?php

class loginController
{
    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if ($username == 'admin' && $password == 'admin') {
                $this->redirect('home');
            } else {
                $loginError = "Invalid username or password";
                require_once 'views/login.php';
            }
        } else {
            require_once 'views/login.php';
        }
    }
}

$loginController = new loginController();
$loginController->login();