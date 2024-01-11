<?php
namespace app\dao;
require_once __DIR__ . '/../../vendor/autoload.php';
 use app\Models\Tag;
 use app\Database\Database;
 use PDO;
 class TagDao{
    private $conn;

    public function __construct(){
        $this->conn= Database::getInstance()->getConnect();
    }

    public function getTags()
    {
        $stmt = $this->conn->prepare("SELECT * from  tags");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    public function getTagsById($id){
        $stmt = $this->conn->prepare("SELECT * from tags where id =?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function addTag(Tag $tag){
        $tagName= $tag->getTagName();
        $query = "INSERT INTO tags (name) VALUES (:tagName)";
        $stm=$this->conn->prepare($query);
        $stm->bindParam(":tagName",$tagName);
        $stm->execute();
    }
    

        public function deleteTag($id){
            $tagId= $id;
            $query = "DELETE FROM tags WHERE id=:tagId";
            $stm=$this->conn->prepare($query);
            $stm->bindParam(":tagId",$tagId);
            $stm->execute();
    
    
    }
    public function updateTag($tagId,$tagName){
        $tagId = $tagId;
        $tagName = $tagName;
        $query = "UPDATE tags SET name=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$tagName,$tagId]);

    

 }
 public function countTags() {
    $query = "SELECT COUNT(*) as tag_count FROM tags";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $data['tag_count'];
}
}
