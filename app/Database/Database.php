<?php
namespace app\Database;
require_once __DIR__ .'/../../vendor/autoload.php';
use Dotenv\Dotenv;
use PDO;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

 class Database{
    private static $instance;
    private  $connection;

    private function __construct(){
            $servername = $_ENV['DB_HOST'];
            $username = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
            $dbname = $_ENV['DB_NAME'];
            $this->connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
            // Check connection
            if (!$this->connection) {
                die("Connection failed: " . mysqli_connect_error());
             }
            
        }
        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new Database();
            }
            return self::$instance;
        }

        public function getConnect(){
            return $this->connection;
        }

}

