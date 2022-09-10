<?php
session_start();
include 'db.php';

class login
{
    public $email;
    public $password;
    public $errors = [];
    function doValidate()
    {
        if (empty(trim($this->email))) {
            $this->addErr('Email is required');
        }
        if (empty(trim($this->password))) {
            $this->addErr('Password is required');
        }
        return $this->errors;
    }
    function addErr($err)
    {
        $this->errors[] = $err;
    }
    function getErr()
    {
        return $this->errors;
    }

    function doLogin()
    {
        // validation here
        if (!$this->doValidate()) {
            $pass = md5($this->password);
            $newDB = new db();
            $conn = $newDB->dbCon();

            $check = "SELECT * FROM `users` WHERE `email` = '$this->email' AND `password` = '$pass'";
            $result = mysqli_query($conn, $check);

            if (mysqli_num_rows($result) > 0) {

                $row = mysqli_fetch_assoc($result);
                $_SESSION['role'] = $row['role'];
                $_SESSION['currLoginEmail'] = $this->email;
                $_SESSION['isLoggedIn'] = 1;
                return true;
            }
        }
        return false;
    }



    function doLogout()
    {
        unset($_SESSION['isLoggedIn']);
        unset($_SESSION['currLoginEmail']);
        unset($_SESSION['role']);
        exit();
    }
}
