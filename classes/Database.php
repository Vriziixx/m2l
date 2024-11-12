
<?php
class Database {
    private $host = "77.93.141.56";
    private $db_name = "s2_databse_axel";
    private $username = "u2_PITicVGUhv";
    private $password = "pLBIgIqDsaO7^!ciyaGLefjy";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8mb4");
        } catch (PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
