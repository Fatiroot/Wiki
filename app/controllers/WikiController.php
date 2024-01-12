<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\dao\CategoryDao;
use app\Models\Wiki;
use app\dao\WikiDao;

// session_start();

class WikiController 
{
    public function addWiki(){
       session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             $image = $_FILES['image']['name']; // Le fichier uploadé
             $temp_name=$_FILES['image']['tmp_name'];
             $uploadDirectory = "../../public/imgs/";
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
        } 
           
        
    }

    public function getAllWikis(){
        $wikidao = new Wikidao();
        $wikis= $wikidao->getWikis();
        include __DIR__ . '../../../views/author/mywikis.php';

    }

     public function updateWiki(){
       session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $image = $_FILES['image']['name']; 
            $temp_name=$_FILES['image']['tmp_name'];
            $uploadDirectory = "../../public/imgs/";
            $destination = $uploadDirectory . $image;
            move_uploaded_file($temp_name, $destination);
           $title = $_POST['title'];
           $id = $_POST['id'];
           $content = $_POST['content'];
           $category =$_POST['categorie_id'];
           $userId =$_SESSION['user_id']; 
           $tag =$_POST['tag_id']; 
           $statut=0;
           
           $wikidao = new Wikidao();
           $wikidao->updateWiki($id, $image, $title, $content, $statut, $category, $userId,$tag);
        //    var_dump($id, $image, $title, $content, $statut, $category, $userId,$tag);
        //    die();
           header('location:homeauthor');
       }      
      
        
   }

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
    public function updateWikiStatut() {
        
        $wikiId = $_POST['id'];
        $newStatus = $_POST['newStatut'];
        $wiki = new WikiDao();  
        $wiki->updateWikiStatut($wikiId, $newStatus);
            header('location: wiki');
        
}
public function countWikis() {
    $wiki =new  WikiDao();
    $wikiCount= $wiki->countWikis();
    return[ $wikiCount];
    
} 
public static function search()
{

    if (isset($_GET["search"])) {
        $searchTerm = $_GET['search'];
        $wiki = new WikiDao();
        $searchResults = $wiki->search($searchTerm);
        echo json_encode($searchResults);
    }
}
 
    
}
?>