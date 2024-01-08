<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use app\routes\Router;
$router = new Router();

$router->setRoutes([
    'GET'=>[
        ''=>['HomeController' , 'index'],
        'home'=>['HomeController' , 'index'],
        'register'=> ['AuthController', 'signup'],
        'login'=>['AuthController' , 'signin'],
        'login'=>['AuthController' , 'signin'],
        'register'=>['AuthController' , 'signup'],
        'dashboard'=>['AuthController' , 'dashboard'],
        
        
    ],
    'POST'=>[
        'register'=>['UserController' , 'register'],
        'login'=>['UserController' , 'login'],
        
        
        
    ]
    
]);
if (isset($_GET['url'])) {
    $uri = trim($_GET['url'], '/');
    $method = $_SERVER['REQUEST_METHOD'];

    try {
        $route = $router->getRoute($method, $uri);
        if ($route) {
            list($controllerName, $methodName) = $route;
            $controllerClass = 'app\\controllers\\' . ucfirst($controllerName);
            $object = new $controllerClass();

            if ($methodName) {
                if (method_exists($object, $methodName)) {
                    $object->$methodName();
                } else {
                    throw new Exception('Method not found in controller.');
                }
            } else {
                $object->index();
            }
        } else {
            throw new Exception('Route not found.');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        
    }
} else {
    echo 'error';
}