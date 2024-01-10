<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\Models\Wiki;
use app\dao\WikiDao;

session_start();

class WikiController 
{
    public function addWiki(){
       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             $image = $_FILES['image']['name']; // Le fichier uploadé
             $temp_name=$_FILES['image']['tmp_name'];
             $uploadDirectory = "/wiki/public/imgs/";
             $destination = $uploadDirectory . $image;
             move_uploaded_file($temp_name, $destination);
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category =$_POST['categorie_id'];
            $userId =$_SESSION['user_id']; 
            $tag =$_POST['tag_id']; 
            $statut=0;
            
            $wikidao = new Wikidao();
            $wikidao->addWiki($image, $title, $content, $statut, $category, $userId, $tag);
            //  var_dump($title, $content, $statut, $category, $userId, $tag);
            //  die();
            header('location:homeauthor');
        } else {
            echo "Le formulaire n'a pas été soumis.";
        }
           
        
    }

    public function getAllWikis(){
        $wikidao = new Wikidao();
        $wikis= $wikidao->getWikis();
        include __DIR__ . '../../../views/author/home.php';

    }

    // public function update(){

    //     $id=$_POST['id'];
    //     $name=$_POST['name'];
        
    //     $wikidao = new Wikidao();
    //     $wiki = new Wiki($id,$name);
    //     $wikidao->update($wiki);
      
        
    // }

    public function deletewiki(){
        $id=$_GET["id"];
        $wikidao = new Wikidao();
        $wikidao->deleteWiki($id);
        header('location: homeauthor');

    }

    public function getwiki()
    {
        $idwiki=$_GET['id'];
        $wikidao = new Wikidao();
        $wiki = $wikidao->getWikisById($idwiki);
        header('location: homeauthor');

    }

    

}
?>