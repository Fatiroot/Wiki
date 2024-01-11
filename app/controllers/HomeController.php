<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\dao\CategoryDao;
use app\dao\TagDao;
use app\dao\WikiDao;
use app\dao\UserDao;
use app\controllers\UserController;
use app\Models\Tag;

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
    public function wiki(){
        $wikidao = new Wikidao();
        $wikis= $wikidao->getWikis();
        include __DIR__ . '../../../views/admin/wiki/list.php';
    }
    public function addwiki(){
        $category= new CategoryDao();
        $Categories = $category->getCategories();
        $tag= new TagDao();
        $tags = $tag->getTags();
        include __DIR__ . '../../../views/author/addwiki.php';
    }

    public function dashboard()
    {
        $user= new UserDao();
        $Users = $user->getAllUsers();

        $cat = new CategoryController();
        list($catCount) = $cat->countCategories();

        $tag = new TagController();
        list($tagCount) = $tag->countTags();

        $wiki = new WikiController();
        list($wikiCount) = $wiki->countwikis();

        $data = new UserController();
        list($userCount) = $data->countUsers();

        include __DIR__ . '../../../views/admin/dashboard.php';
    }
 


    
   
}