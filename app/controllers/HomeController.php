<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\dao\CategoryDao;
use app\dao\TagDao;
use app\dao\WikiDao;
use app\dao\UserDao;
use app\controllers\UserController;
use app\Models\Category;
use app\Models\Tag;
use App\Models\Wiki;

class HomeController{
public function index(){
        $wikidao = new Wikidao();
        $wikis= $wikidao->getlastWikis();
        $catdao = new Categorydao();
        $categories= $catdao->getlastCategories();
        include __DIR__ . '../../../views/home.php';
    }
    public function indexauthor(){
        $wikidao = new Wikidao();
        $wikis= $wikidao->getlastWikis();
        $catdao = new Categorydao();
        $categories= $catdao->getlastCategories();
        include __DIR__ . '../../../views/author/home.php';
        }
    public function addCat(){
        session_start();

        $user = new UserDao();
        $Id = $_SESSION['user_id'];
        $users = $user->getUserById($Id);
        include __DIR__ . '../../../views/admin/category/add.php';
    }
    public function addTag(){
        session_start();

        $user = new UserDao();
        $Id = $_SESSION['user_id'];
        $users = $user->getUserById($Id);
        include __DIR__ . '../../../views/admin/tag/add.php';
    }
    public function wiki(){
        session_start();

        $user = new UserDao();
        $Id = $_SESSION['user_id'];
        $users = $user->getUserById($Id);

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
        
        $data = new UserController();
        list($userCount) = $data->countUsers();


        $user = new UserDao();
        session_start();

        $Id = $_SESSION['user_id'];
        $users = $user->getUserById($Id);

        $Users = $user->getAllUsers();

        $cat = new CategoryController();
        list($catCount) = $cat->countCategories();

        $tag = new TagController();
        list($tagCount) = $tag->countTags();

        $wiki = new WikiController();
        list($wikiCount) = $wiki->countwikis();


        include __DIR__ . '../../../views/admin/dashboard.php';
    }
 

    public function updateWiki(){
        $id = $_GET['id'];
        $wiki = new WikiDao();
        $Wikis= $wiki->getWikisById($id);
        $category= new CategoryDao();
        $Categories = $category->getCategories();
        $tag= new TagDao();
        $tags = $tag->getTags();
        // print_r($Wikis);
        // exit();
       
        include __DIR__ . '../../../views/author/updatewiki.php';
        }
    
   
}