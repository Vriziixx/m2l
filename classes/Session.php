<?php
require_once 'Database.php';

class Session {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer toutes les sessions
    public function getAllSessions() {
        $query = "SELECT id, nom_session, date_session, heure_session, prix_session FROM session";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}