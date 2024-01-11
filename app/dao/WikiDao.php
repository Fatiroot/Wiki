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
        // $stmt = $this->conn->prepare("SELECT * from  wikis");
        $stmt = $this->conn->prepare(" SELECT w.*,w.id, u.username, c.name 
        FROM wikis AS w 
        INNER JOIN users AS u ON (u.id = w.user_id) 
        INNER JOIN categories AS c ON (c.id = w.categorie_id) ");

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    public function getWikisById($id){
        $stmt = $this->conn->prepare("SELECT * FROM wikis where id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    


    public function addWiki($image, $title, $content, $statut, $categoryId, $userId, $tags)
    {
        try {
            $this->conn->beginTransaction();
    
            $sql = "INSERT INTO `wikis`(`image`, `title`, `centent`, `creation_date`, `statut`, `categorie_id`, `user_id`) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?, ?, ?)";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$image, $title, $content, $statut, $categoryId, $userId]);
    
            $lastInsertedId = $this->conn->lastInsertId();
    
            $sqlTagWiki = "INSERT INTO `tag_wiki` (`tag_id`, `wiki_id`) VALUES (?, ?)";
            $stmtTagWiki = $this->conn->prepare($sqlTagWiki);
        
            foreach ($tags as $tagId) {
                $resultTag = $stmtTagWiki->execute([$tagId, $lastInsertedId]);
                if (!$resultTag) {
                    // Log or handle tag insertion failure
                    error_log("Tag insertion failed for tag ID: $tagId");
                }
            }
    
            $this->conn->commit();
    
        } catch (\PDOException $e) {
            $this->conn->rollBack();
            // Log or handle the error more effectively than just echoing here
            error_log("Error: " . $e->getMessage());
        }
    }
    
  
public  function deleteWiki($wikiId)
{
    try {
        $this->conn->beginTransaction();

        $query = "DELETE FROM `wikis` WHERE `id` = ?";
        $stm = $this->conn->prepare($query);
        $stm->execute([$wikiId]);

        $query = "DELETE FROM `tag_wiki` WHERE `wiki_id` = ?";
        $stm = $this->conn->prepare($query);
        $stm->execute([$wikiId]);

        $this->conn->commit();

    } catch (\PDOException $e) {
        $this->conn->rollBack();
        echo "Error : " . $e->getMessage();
    } 
}
public function updateWiki($id, $image, $title, $content, $statut, $categoryId, $userId, $tags)
{
    try {
        $this->conn->beginTransaction();

        $sql = "UPDATE `wikis` 
                SET `image` = ?, `title` = ?, `centent` = ?, `statut` = ?,  `category_id` = ?, `user_id` = ? 
                WHERE `id` = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$image, $title, $content, $statut, $categoryId, $userId, $id]);
        $query = "DELETE FROM `tag_wiki` WHERE `wiki_id` = ?";
        $stm = $this->conn->prepare($query);
        $stm->execute([$id]);

        $sqlTagWiki = "INSERT INTO `tag_wiki` (`tag_id`, `wiki_id`) VALUES (?, ?)";
        $stmtTagWiki = $this->conn->prepare($sqlTagWiki);

        foreach ($tags as $tagId) {
            $resultTag = $stmtTagWiki->execute([$tagId, $id]);
            if (!$resultTag) {
                // Log or handle tag insertion failure
                error_log("Tag insertion failed for tag ID: $tagId");
            }
        }

        $this->conn->commit();

    } catch (\PDOException $e) {
        $this->conn->rollBack();
        echo "Error : " . $e->getMessage();
    }
}


public function updateWikiStatut($wikiId, $newStatut) {
 
        $sql = "UPDATE wikis SET statut = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$newStatut, $wikiId]);

      
    
}
public function countWikis() {
    $query = "SELECT COUNT(*) as wiki_count FROM wikis";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $data['wiki_count'];
}

}
