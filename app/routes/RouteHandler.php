<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use app\routes\Router;
$router = new Router();

$router->setRoutes([
    'GET'=>[
        ''=>['HomeController' , 'index'],
        'home'=>['HomeController' , 'index'],
        'wiki'=>['HomeController' , 'wiki'],
        'homeauthor'=>['WikiController','getAllWikis'],
        'register'=> ['AuthController', 'signup'],
        'login'=>['AuthController' , 'signin'],
        'login'=>['AuthController' , 'signin'],
        'register'=>['AuthController' , 'signup'],
        // 'dashboard'=>['AuthController' , 'dashboard'],
        'category'=>['CategoryController' , 'getAllCategories'],
        'deleteCat'=>['CategoryController' , 'deleteCateg'],
        'addCat'=>['HomeController','addCat'],
        'addTag'=>['HomeController','addTag'],
        'updateCat'=>['CategoryController','getCat'],
        'updateTag'=>['TagController','getTag'],
        'tag'=>['TagController' , 'getAllTags'],
        'deleteTag'=>['TagController' , 'deleteTag'],
        'dashboard'=>['UserController' , 'getAllUsers'],
        'deleteUser'=>['UserController' , 'deleteUser'],
        'addwiki'=>['HomeController','addwiki'],
        'deletewiki'=>['WikiController' , 'deletewiki'],
        


    ],
    'POST'=>[
        'register'=>['UserController' , 'register'],
        'login'=>['UserController' , 'login'],
        'addCat'=>['CategoryController','addCategory'],
        'updateCat'=>['CategoryController','updateCateg'],
        'updateTag'=>['TagController','updateTags'],
        'addTag'=>['TagController','addTag'],
        'addwiki'=>['WikiController','addwiki'],
        'updatestatut'=>['WikiController','updateWikiStatut'],

        
 
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