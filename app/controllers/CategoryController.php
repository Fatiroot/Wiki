<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\Models\Category;
use app\dao\CategoryDao;

class CategoryController{


    public function addCategory(){

        if (isset($_POST["addcategory"])){

            $catName = $_POST ['categoryName'];

            $category = new Category($catName);

            $catdao = new CategoryDao();

            $result = $catdao->addCategory( $category);
                header('location: category');


        }

    }
    public function getAllCategories() {
        $category= new CategoryDao();
        $Categories = $category->getCategories();
        include __DIR__ . '../../../views/admin/category/list.php';

    }
    public function deleteCateg(){
        if(isset($_GET['id'])){
            $catId = $_GET['id'];
           

            $category = new CategoryDao();
             $category-> deleteCategory($catId);
            header('location: category');
            
    }
    }
    public function getCat()
    {
        $id = $_GET['id'];
        $category = new CategoryDao();
        $cats = $category->getCategories();
        $oneCategory = $category->getCategoryById($id);
        require_once '../../views/admin/category/update.php';
    }

    // }
    public function updateCateg(){
        if(isset($_POST['updatecategory'])){
        $postData = $_POST ;
        $catName = $postData['categoryName'];
        $catId = $postData['id'];

        $cat = new CategoryDao();

        $result = $cat->updateCategory($catId,$catName);
            header('location: category');
        
    } }
    


}
