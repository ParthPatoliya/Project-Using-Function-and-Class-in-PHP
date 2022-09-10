<?php
include 'db.php';
class users
{
    public $name;
    public $email;
    public $password;
    public $conf_pass;
    public $phone;
    public $designation;
    public $role;
    public $errors =  [];

    public function doValidate()
    {
        $newDB = new db();
        $conn = $newDB->dbCon();
        $emailExists = "SELECT * FROM `users` WHERE `email` = '$this->email'";
        $result = mysqli_query($conn, $emailExists);
        if (mysqli_num_rows($result) > 0) {
            $this->addErr('Email already exists');
        }

        if (empty(trim($this->name))) {
            $this->addErr('Name is required');
        }
        if (empty(trim($this->email))) {
            $this->addErr('Email is required');
        }
        if (empty(trim($this->password))) {
            $this->addErr('Password is required');
        }
        if (empty(trim($this->conf_pass))) {
            $this->addErr('Confirm password is required');
        }
        if ($this->password != $this->conf_pass) {
            $this->addErr('Passwords do not match');
        }
        if (strlen($this->password) < 6) {
            $this->addErr('Password must be at least 6 characters');
        }
        if (empty(trim($this->phone))) {
            $this->addErr('Phone is required');
        }
        if (strlen($this->phone) < 10) {
            $this->addErr('Phone must be at least 10 characters');
        }
        if (empty(trim($this->designation))) {
            $this->addErr('Designation is required');
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


    public function doRegister()
    {

        if (!$this->doValidate()) {


            $newDB = new db();
            $conn = $newDB->dbCon();
            $pass = md5($this->password);
            $role = strtolower($this->role);
            $sql = "INSERT INTO `users` (`name`, `email`, `password`, `phone`, `designation`, `role`) VALUES ('$this->name', '$this->email', '$pass', '$this->phone', '$this->designation', '$role')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                return true;
            }
        } else {
            return $this->getErr();
        }
    }

    function getUser()
    {
        $newDB = new db();
        $conn = $newDB->dbCon();
        $sql = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    function deleteUser($email)
    {
        $newDB = new db();
        $conn = $newDB->dbCon();
        $sql = "DELETE FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            return true;
        }
    }
    function updateUser($email)

    {
        $newDB = new db();
        $conn = $newDB->dbCon();
        $pass = md5($this->password);
        $role = strtolower($this->role);
        $sql = "UPDATE `users` SET `name` = '$this->name', `email` = '$this->email', `password` = '$pass', `phone` = '$this->phone', `designation` = '$this->designation', `role` = '$role' WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            return true;
        }
    }
}
