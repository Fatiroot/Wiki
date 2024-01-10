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
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category =$_POST['categorie_id'];
            $userId =$_SESSION['user_id']; 
            $tag =$_POST['tag_id']; 
            $statut=0;
           
            $wikidao = new Wikidao();
            $wikidao->addWiki($image, $title, $content, $statut, $category, $userId, $tag);
            header('location:homeauthor');
        } else {
            echo "Le formulaire n'a pas été soumis.";
        }
           
        
    }

    // public function getAllWikis(){
    //     $wikidao = new Wikidao();
    //     $wikis= $wiki->getAllWikis();
    // }

    // public function update(){

    //     $id=$_POST['id'];
    //     $name=$_POST['name'];
        
    //     $wikidao = new Wikidao();
    //     $wiki = new Wiki($id,$name);
    //     $wikidao->update($wiki);
      
        
    // }

    // public function delete(){
    //     $id=$_GET["id"];
    //     $wikidao = new Wikidao();
    //     $wikidao->delete($id);
    // }

    // public function getwiki()
    // {
    //     $id=$_GET['id'];
    //     $wikidao = new Wikidao();
    //     $wiki = $wikidao->getWikiById($id);
    // }

    

}
?>