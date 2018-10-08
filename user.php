<?php

class User
{
    private $username;
    private $email;
    private $sexo;
    private $direction;
    private $provincia;
    private $password;
    

    public function __construct(String $username, String $email, String $sexo, sting $direccion, string $provincia, String $password) 
    {
        $this->username = $username;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->direction = $direction;
        $this->provincia =$provincia;
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

    public function setSexo(String $sexo)
    {
        $this->sexo = $sexo;
    }

    public function getDirection(): String
    {
        return $this->direction;
    }

    public function setDirection(String $direction)
    {
        $this->direction  = $direction;
    }
    public function getProvincia(): String
    {
        return $this->provincia;
    }

    public function setProvincia(String $provincia)
    {
        $this->provincia = $provincia;
    }
 
    public function getPassword(): String
    {
        return $this->password = $password; 
    }

    public function setPassword(String $password)
    {
        $this->password = $password;
    }
 

 
}





