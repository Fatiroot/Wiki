<?php
namespace app\dao;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\Database\Database;
use app\Models\User;
use PDO;

class UserDao
{
    private $conn;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnect();
    }

    public function createUser(User $user){
        $userName = $user->getUserName();
        $email = $user->getEmail();
        $phone = $user->getPhone();
        $password = $user->getPassword();
        $role_id = '2';

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, phone, password, role_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $success = $stmt->execute([$userName, $email, $phone, $hashedPassword, $role_id]);

        if ($success) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($email){
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user; // Return the user details as an associative array
        } else {
            return null; // User not found
        }
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }
   
    public function getUserById($id){
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function updateUser(User $user){
        $query = "UPDATE users SET username = :username, email = :email, password = :password, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':username', $user->getUserName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':phone', $user->getPhone());
        $stmt->execute();
    }

    public function deleteUser($id){
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}