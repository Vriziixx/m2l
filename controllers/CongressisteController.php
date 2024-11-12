<?php
require_once '../classes/Congressiste.php';

class CongressisteController {
    public function handleRequest() {
        $action = $_POST['action'] ?? null;

        switch ($action) {
            case 'add':
                $this->addCongressiste();
                break;
            case 'update':
                $this->updateCongressiste();
                break;
            case 'delete':
                $this->deleteCongressiste();
                break;
            default:
                header("Location: ../views/list_congressistes.php");
        }
    }

    private function addCongressiste() {
        $congressiste = new Congressiste();
        $congressiste->setNomCongre($_POST['nom_congre']);
        $congressiste->setPrenom($_POST['prenom']);
        $congressiste->setAdresse($_POST['adresse']);
        $congressiste->setTel($_POST['tel']);
        $congressiste->setDateInscription(date('Y-m-d')); // Date d'inscription automatique
        $congressiste->setNumOrganisme($_POST['num_organisme']);
        $congressiste->setNumHotel($_POST['num_hotel']);
        $congressiste->addCongressiste();

        // Enregistrement des participations aux sessions
        $sessions = $_POST['sessions'] ?? [];
        foreach ($sessions as $sessionId) {
            $congressiste->addSession($sessionId);
        }

        header("Location: ../views/list_congressistes.php");
    }

    private function updateCongressiste() {
        $congressiste = new Congressiste();
        $congressiste->setNomCongre($_POST['nom_congre']);
        $congressiste->setPrenom($_POST['prenom']);
        $congressiste->setAdresse($_POST['adresse']);
        $congressiste->setTel($_POST['tel']);
        $congressiste->setDateInscription($_POST['date_inscription']);
        $congressiste->setNumOrganisme($_POST['num_organisme']);
        $congressiste->setNumHotel($_POST['num_hotel']);
        $congressiste->updateCongressiste($_POST['id']);

        // Mise à jour des participations aux sessions
        $congressiste->removeAllSessions($_POST['id']); // Supprime toutes les sessions liées
        $sessions = $_POST['sessions'] ?? [];
        foreach ($sessions as $sessionId) {
            $congressiste->addSession($sessionId);
        }

        header("Location: ../views/list_congressistes.php");
    }

    private function deleteCongressiste() {
        $congressiste = new Congressiste();
        $congressiste->deleteCongressiste($_POST['id']);
        
        header("Location: ../views/list_congressistes.php");
    }
}

$controller = new CongressisteController();
$controller->handleRequest();
