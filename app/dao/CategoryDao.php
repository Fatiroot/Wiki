<?php
namespace app\dao;
require_once __DIR__ . '/../../vendor/autoload.php';
 use app\Models\Category;
 use app\Database\Database;
 use PDO;
 use PDOException;

 class CategoryDao{
    private $conn;

    public function __construct(){
        $this->conn= Database::getInstance()->getConnect();
    }

    public function getCategories()
    {
        $stmt = $this->conn->prepare("SELECT * from  categories");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    public function getCategoryById($id){
        $stmt = $this->conn->prepare("SELECT * from categories where id =?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function addCategory(Category $cat){
        $categoryName= $cat->getcategoryName();
        
        $query = "INSERT INTO categories (name) VALUES (:categoryName)";
        $stm=$this->conn->prepare($query);
        $stm->bindParam(":categoryName",$categoryName);
        $stm->execute();
    }
    

        public function deleteCategory($id){
            $categoryId= $id;
            
            $query = "DELETE FROM categories WHERE id=:categoryId";
            $stm=$this->conn->prepare($query);
            $stm->bindParam(":categoryId",$categoryId);
            $stm->execute();
    
    
    }
    public function updateCategory($catId,$catName){

        $categoryId = $catId;
        $categoryName = $catName;

        $query = "UPDATE categories SET name=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$categoryName,$categoryId]);

    

 }
 public function countCategories() {
    $query = "SELECT COUNT(*) as cat_count FROM categories";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $data['cat_count'];
}
}
