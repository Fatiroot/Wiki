<?php
namespace app\Models;

class User{
    private $id;
    private $userName;
    private $email;
    private $phone;
    private $password;
    private $role_id;

    public function __construct($userName,$email,$phone,$password,$role_id){
        $this->userName=$userName;
        $this->email=$email;
        $this->phone=$phone;
        $this->password=$password;
        $this->role_id=$role_id;

    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }

    public function getRoleId() {
        return $this->role_id;
    }

}