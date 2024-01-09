<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\dao\UserDao;
use app\Models\User;

class UserController{

    public function register() {
        if (isset($_POST['register'])) {
        $postData = $_POST ?? [];
        $username =$postData['username'] ?? '';
        $email = $postData['email'] ?? '';
        $phone = $postData['phone'] ?? '';
        $password = $postData['password'] ?? '';
        
        // Set initial values for image, status, and role_id 
        $role_id = 2; 
    
        // Create a Users object
        $user = new User($username, $email, $phone, $password, $role_id);
    
        // Create an instance of UserServices
        $users = new UserDao();
    
        // Call the createUser method in UserServices to handle user creation logic
        $result = $users->createUser($user);
    
        // Return the result
        if ($result) {
            // User created successfully
            header('location:login');
            exit();
        } else {
            return false;
        }
    }
      
    }
    public function login() {
        if (isset($_POST['login'])){
        $postData = $_POST ?? [];
        $email = $postData['email'] ?? '';
        $password = $postData['password'] ?? '';
    
        $users = new UserDao();
    
        // Get user details by email
        $user = $users->getUserByEmail($email);
    
        if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['role_id'] = $user['role_id'];
    
                // Redirect based on user's role
                $role = $user['role_id'];
                if ($role === 1) {
                    header('Location: dashboard');
                    exit();
                } else if ($role === 2 ) {
                    header('Location: home');
                    exit();
    
                } 
            } else {
                session_start();
                $_SESSION['login_error'] = 'Invalid credentials. Please try again.';
                header('Location: login');
                exit();
            }
        }
    }

    public function logout() {
       
        session_start();

        // Unset all of the session variables
        $_SESSION = [];

        session_destroy();

        header('Location: login'); 
        exit();
    
}
 

}