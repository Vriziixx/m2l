<?php
require_once 'Database.php';

class Organisme {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer tous les organismes
    public function getAllOrganismes() {
        $query = "SELECT id, nom, adresse, tel FROM organisme";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}