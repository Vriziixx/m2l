<?php
require_once 'Database.php';

class Hotel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer tous les hôtels
    public function getAllHotels() {
        $query = "SELECT id, nom_hotel, adresse_hotel, nombre_etoiles, prix_participant, prix_supplementaire FROM hotel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
