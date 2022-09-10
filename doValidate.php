<?php

class validate
{

    public $name;
    public $email;
    public $password;
    public $conf_pass;
    public $phone;
    public $desi;
    // public $role;
    public $errors = array();

    public function __construct($name, $email, $password, $conf_pass, $phone, $desi)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->$conf_pass = $conf_pass;
        $this->phone = $phone;
        $this->desi = $desi;
    }

    public function doValidate()
    {

        if (empty(trim($this->name))) {
            // $this->errors['name'];
            array_push($this->errors, "Name is required");
        }
        if (!filter_var($this->email)) {
            // $this->errors['email'];
            array_push($this->errors, "Email is invalid");
        }
        if (empty(trim($this->password))) {
            // $this->errors['password'];
            array_push($this->errors, "Password is required");
        } elseif (strlen($this->password) < 6) {
            // $this->errors['password'];
            array_push($this->errors, "Password must be at least 6 characters");
        } elseif ($this->password != $this->conf_pass) {
            // $this->errors['password'];
            array_push($this->errors, "Password does not match");
        }
        if (empty(trim($this->phone)) || strlen($this->phone) > 10) {
            // $this->errors['phone'];
            array_push($this->errors, "Phone is required and must be at least 10 characters");
        }
        if (empty(trim($this->desi))) {
            // $this->errors['desi'];
            array_push($this->errors, "Designation is required");
        }

        return $this->errors;
    }
}
