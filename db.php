<?php

class db
{
    public $conn;
    public function dbCon()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "project");
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->conn;
    }
}
