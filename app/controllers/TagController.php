<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\Models\Tag;
use app\dao\TagDao;
use app\dao\UserDao;

class TagController{


    public function addTag(){
            $tagName = $_POST ['tagName'];

            $tag = new tag($tagName);

            $tagdao = new TagDao();

            $result = $tagdao->addTag( $tag);
                header('location: tag');

    }
      
    public function getTag()
    {
            $tagId = $_GET['id'];
            $tagdao = new TagDao();
             $tag=$tagdao-> getTagsById($tagId);
             include __DIR__ . '../../../views/admin/tag/update.php';
            }

    public function getAllTags() {
        session_start();

        $user = new UserDao();
        $Id = $_SESSION['user_id'];
        $users = $user->getUserById($Id);
        $tag= new TagDao();
        $tags = $tag->getTags();
        include __DIR__ . '../../../views/admin/tag/list.php';

    }

    public function deleteTag(){
        if(isset($_GET['id'])){
            $tagId = $_GET['id'];
           
            $tagdao = new TagDao();
             $tagdao-> deleteTag($tagId);
            header('location: tag');
            
    }
}
    
public function updateTags(){
    $tagId=$_POST['id'];
    $tagName=$_POST['tagName'];
    $tag =new TagDao();
    $result= $tag->updateTag($tagId, $tagName);
    header('location: tag');


}
public function countTags() {
    $tag =new  TagDao();
    $tagCount= $tag->countTags();
    return[ $tagCount];
    
}

}
