<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $sexo;
    private $provincia;
    private $direccion;
    private $password;
    private $avatar;
    

    // public function __construct(String $username, String $email, String $sexo, String $direccion, String $provincia, String $password) 
    // {
        // $this->id = Validate::idGenerate();
        // $this->username = $username;
        // $this->email = $email;
        // $this->sexo = $sexo;
        // $this->direccion = $direccion;
        // $this->provincia =$provincia;
        // $this->password = $this->hashPassword($password);
    // }

    public function __construct($data, $avatar = "", bool $newUser = true){
        $this->id = Validate::idGenerate();
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->sexo = $data['sexo'];
        $this->direccion = $data['direccion'];
        $this->provincia =$data['provincia'];
        $this->password = $this->hashPassword($data['password'], $newUser);
        $this->avatar = $avatar;
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function setUsername(String $userName)
    {
        $this->username = $userName;
    }
 
    public function getEmail(): String
    {
        return $this->email;
    }

    public function setEmail(String $email)
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

    public function getDireccion(): String
    {
        return $this->direccion;
    }

    public function setDireccion(String $direccion)
    {
        $this->direccion = $direccion;
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
        return $this->password;
    }

    public function setPassword(String $password)
    {
        $this->password = $password;
    }

    public function getAvatar(): String
    {
        return $this->avatar;
    }

    public function setAvatar(String $avatar){
        $this->avatar = $avatar;
    }

    public function toJson(){
        return json_encode(array(
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'direccion' => $this->direccion,
            'provincia' => $this->provincia,
            'password' => $this->password,
            'role' => 1,
            'avatar' => $this->avatar
        ));
    }

    private function hashPassword($password, $newUser = false){
        if($newUser){
            dd("HASHEO");
            return password_hash($password, PASSWORD_DEFAULT);
        } else {
            dd("DEVUELVE DE JSON");
            return $this->password;
        }
    }
}
?>