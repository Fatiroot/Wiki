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
        include __DIR__ . '../../../views/admin/category.php';

    }
    public function deleteCateg(){
        if(isset($_GET['id'])){
            $catId = $_GET['id'];
           

            $category = new CategoryDao();
             $category-> deleteCategory($catId);
            header('location: category');
            
    }
    }


}
