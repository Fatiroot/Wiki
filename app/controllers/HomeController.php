<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\dao\CategoryDao;
use app\dao\TagDao;

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
    public function homeauthor(){
        include __DIR__ . '../../../views/author/home.php';
    }
    public function addwiki(){
        $category= new CategoryDao();
        $Categories = $category->getCategories();
        $tag= new TagDao();
        $tags = $tag->getTags();
        include __DIR__ . '../../../views/author/addwiki.php';
    }

    
   
}