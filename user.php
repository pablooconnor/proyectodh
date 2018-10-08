<?php

class User
{
    private $username;
    private $email;
    private $sexo;
    private $password;
    

    public function __construct(String $username, String $email, String $sexo, String $password) 
    {
        $this->username = $username;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->password = $password;
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function setUsername(String $userName)
    {
        $this->username = $userName;
    }
 
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

    }

    public function getSexo(): String
    {
        return $this->sexo;
    }

    public function setSexo(String $userName)
    {
        $this->sexo = $sexo;
    }

    public function getPassword(): String
    {
        return $this->password;
    }

    public function setPassword(String $password)
    {
        $this->password = $password;
    }
 

 
}





