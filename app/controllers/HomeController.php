<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

class HomeController{
    public function index(){
        include __DIR__ . '../../../views/home.php';
    }
    public function addCat(){
        include __DIR__ . '../../../views/admin/category/add.php';
    }
    public function addTag(){
        include __DIR__ . '../../../views/admin/tag/add.php';
    }
    


   
}