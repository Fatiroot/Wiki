<?php
namespace app\dao;
require_once __DIR__ . '/../../vendor/autoload.php';
 use app\Models\Wiki;
 use app\Database\Database;
 use PDO;
 class WikiDao{
    private $conn;

    public function __construct(){
        $this->conn= Database::getInstance()->getConnect();
    }
    public function getWikis()
    {
        $stmt = $this->conn->prepare("SELECT * from  wikis");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    
    public function getWikisById($id){
        $stmt = $this->conn->prepare("SELECT * from wikis where id =?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function insertTagsForWiki($wikiId, $tags)
    {
        $sqlTagWiki = "INSERT INTO `tag_wiki` (`tag_id`, `wiki_id`) VALUES (?, ?)";
        $stmtTagWiki = $this->conn->prepare($sqlTagWiki);
    
        foreach ($tags as $tagId) {
            $stmtTagWiki->execute([$tagId, $wikiId]);
        }
    }

    public function addWiki($image,$title, $content, $statut, $categoryId, $userId, $tags)
{
    try {
        $this->conn->beginTransaction();

        $sql = "INSERT INTO `wikis` (`image`, `title`, `content`, `creation_date`, `statut`, `category_id`, `user_id`) 
                VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$image, $title, $content, $statut, $categoryId, $userId]);

        $lastInsertedId = $this->conn->lastInsertId();

        $this->insertTagsForWiki($lastInsertedId, $tags);

        $this->conn->commit();

    } catch (\PDOException $e) {
        $this->conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
  
public function deleteTagsForWiki($wikiId)
{
    $query = "DELETE FROM `tag_wiki` WHERE `wiki_id` = ?";
    $stm = $this->conn->prepare($query);
    $stm->execute([$wikiId]);
}

public  function deleteWiki($wikiId)
{
    try {
        $this->conn->beginTransaction();

        $query = "DELETE FROM `wikis` WHERE `id` = ?";
        $stm = $this->conn->prepare($query);
        $stm->execute([$wikiId]);

        self::deleteTagsForWiki($wikiId);

        $this->conn->commit();

    } catch (\PDOException $e) {
        $this->conn->rollBack();
        echo "Error : " . $e->getMessage();
    } 
}
public function editWiki($wikiId, $image, $title, $content, $statut, $categoryId, $userId, $tags)
{
    try {
        $this->conn->beginTransaction();

        $sql = "UPDATE `wikis` 
                SET `image` = ?, `title` = ?, `content` = ?, `statut` = ?,  `category_id` = ?, `user_id` = ? 
                WHERE `id` = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$image, $title, $content, $statut, $categoryId, $userId, $wikiId]);

        $this->deleteTagsForWiki($wikiId);

        $this->insertTagsForWiki($wikiId, $tags);

        $this->conn->commit();

    } catch (\PDOException $e) {
        $this->conn->rollBack();
        echo "Error : " . $e->getMessage();
    } 
    
}
}
