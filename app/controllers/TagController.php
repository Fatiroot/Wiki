<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use app\Models\Tag;
use app\dao\TagDao;

class TagController{


    public function addTag(){
            $tagName = $_POST ['tagName'];

            $tag = new tag($tagName);

            $tagdao = new TagDao();

            $result = $tagdao->addTag( $tag);
                header('location: tag');


        

    }
    public function getAllTags() {
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
    


}
