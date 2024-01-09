<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

class HomeController{
    public function index(){
        include __DIR__ . '../../../views/home.php';
    }
    public function addCat(){
        include __DIR__ . '../../../views/admin/addCat.php';
    }


   
}