<?php

namespace App\User;

class User
{
    private $email;
    private $password;
    private $unitPrice;
    private $id;

    //instantiate product object 
    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

}