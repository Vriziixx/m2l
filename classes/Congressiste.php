<?php
require_once 'Database.php';

class Congressiste {
    private $conn;
    private $id;
    private $nom_congre;
    private $prenom;
    private $adresse;
    private $tel;
    private $date_inscription;
    private $num_organisme;
    private $num_hotel;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Setters
    public function setNomCongre($nom_congre) { $this->nom_congre = $nom_congre; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setAdresse($adresse) { $this->adresse = $adresse; }
    public function setTel($tel) { $this->tel = $tel; }
    public function setDateInscription($date_inscription) { $this->date_inscription = $date_inscription; }
    public function setNumOrganisme($num_organisme) { $this->num_organisme = $num_organisme; }
    public function setNumHotel($num_hotel) { $this->num_hotel = $num_hotel; }

    // Method pour ajouter un congressiste
    public function addCongressiste() {
        $query = "INSERT INTO congressiste (nom_congre, prenom, adresse, tel, date_inscription, num_organisme, num_hotel)
                  VALUES (?, ?, ?, ?, CURDATE(), ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->nom_congre, $this->prenom, $this->adresse, $this->tel, $this->num_organisme, $this->num_hotel]);
        $this->id = $this->conn->lastInsertId();
    }
    

    // Method pour get tout les congressistes
    public function getAllCongressistes() {
        $query = "SELECT c.id, c.nom_congre, c.prenom, c.adresse, c.tel, c.date_inscription, o.nom AS organisme_nom, h.nom_hotel AS hotel_nom
                  FROM congressiste c
                  LEFT JOIN organisme o ON c.num_organisme = o.id
                  LEFT JOIN hotel h ON c.num_hotel = h.id
                  ORDER BY c.nom_congre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method pour get un congressiste spécifique par son ID
    public function getCongressiste($id) {
        $query = "SELECT c.id, c.nom_congre, c.prenom, c.adresse, c.tel, c.date_inscription, o.nom AS organisme_nom, h.nom_hotel AS hotel_nom
                  FROM congressiste c
                  LEFT JOIN organisme o ON c.num_organisme = o.id
                  LEFT JOIN hotel h ON c.num_hotel = h.id
                  WHERE c.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method pour update un congressiste
    public function updateCongressiste($id) {
        $query = "UPDATE congressiste
                  SET nom_congre = ?, prenom = ?, adresse = ?, tel = ?, date_inscription = ?, num_organisme = ?, num_hotel = ?
                  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->nom_congre, $this->prenom, $this->adresse, $this->tel, $this->date_inscription, $this->num_organisme, $this->num_hotel, $id]);
    }

    // Method pour supprimer un congressiste
    public function deleteCongressiste($id) {
        $query = "DELETE FROM congressiste WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    // Method pour ajouter une session à un congressiste (dans la table participation_session)
    public function addSession($sessionId) {
        $query = "INSERT INTO participation_session (num_congressiste, num_session) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->id, $sessionId]);
    }

    public function removeAllSessions($congressisteId) {
        $query = "DELETE FROM participation_session WHERE num_congressiste = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$congressisteId]);
    }
    

    // Method pour get les sessions spécifique pour un congressiste
    public function getSessions($id) {
        $query = "SELECT s.id, s.nom_session, s.date_session, s.heure_session, s.prix_session
                  FROM session s
                  JOIN participation_session ps ON s.id = ps.num_session
                  WHERE ps.num_congressiste = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
