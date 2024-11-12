<?php
require_once '../classes/Hotel.php';
require_once '../classes/Organisme.php';
require_once '../classes/Session.php';

$hotel = new Hotel();
$organisme = new Organisme();
$session = new Session();

// Récupération des données pour remplir les listes déroulantes dans le formulaire
$hotels = $hotel->getAllHotels(); 
$organismes = $organisme->getAllOrganismes(); 
$sessions = $session->getAllSessions(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Congressistes</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js" defer></script>
    <script>
        const hotels = <?php echo json_encode($hotels); ?>;
        const organismes = <?php echo json_encode($organismes); ?>;
        const sessions = <?php echo json_encode($sessions); ?>;
    </script>
</head>

<body>
    <div class="container">
        <h1>Liste des Congressistes</h1>
        <button id="addButton" onclick="openForm()">Ajouter un Congressiste</button>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Date Inscription</th>
                    <th>Organisme</th>
                    <th>Hôtel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../classes/Congressiste.php';
                $congressisteModel = new Congressiste();
                $congressistes = $congressisteModel->getAllCongressistes();    

                foreach ($congressistes as $congressiste) {
                    // Conversion des sessions en une liste d'ID
                    $sessions = array_column($congressisteModel->getSessions($congressiste['id']), 'id');
                    echo "<tr>
                            <td>{$congressiste['nom_congre']}</td>
                            <td>{$congressiste['prenom']}</td>
                            <td>{$congressiste['adresse']}</td>
                            <td>{$congressiste['tel']}</td>
                            <td>{$congressiste['date_inscription']}</td>
                            <td>{$congressiste['organisme_nom']}</td>
                            <td>{$congressiste['hotel_nom']}</td>
                            <td>
                                <button class='editBtn' onclick='openEditForm(\"{$congressiste['id']}\", \"{$congressiste['nom_congre']}\", \"{$congressiste['prenom']}\", \"{$congressiste['adresse']}\", \"{$congressiste['tel']}\", \"{$congressiste['date_inscription']}\", \"{$congressiste['organisme_nom']}\", \"{$congressiste['hotel_nom']}\", " . json_encode($sessions) . ")'>Modifier</button>
                                <button class='deleteBtn' onclick='confirmDelete(\"{$congressiste['id']}\")'>Supprimer</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Formulaire d'ajout/modification de congressiste -->
        <div id="formPopup" class="form-popup">
            <form action="../controllers/CongressisteController.php" method="POST" class="form-container">
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="id" id="id">

                <label for="nom_congre">Nom :</label>
                <input type="text" name="nom_congre" id="nom_congre" required>

                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" required>

                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" required>

                <label for="tel">Téléphone :</label>
                <input type="text" name="tel" id="tel" required>

                <label for="date_inscription">Date d'Inscription :</label>
                <input type="text" name="date_inscription" id="date_inscription" required>

                <label for="num_organisme">Organisme :</label>
                <select name="num_organisme" id="num_organisme">
                    <option value="">Sélectionner un organisme</option>
                    <?php
                    foreach ($organismes as $org) {
                        echo "<option value='{$org['id']}'>{$org['nom']}</option>";
                    }
                    ?>
                </select>

                <label for="num_hotel">Hôtel :</label>
                <select name="num_hotel" id="num_hotel">
                    <option value="">Sélectionner un hôtel</option>
                    <?php
                    foreach ($hotels as $h) {
                        echo "<option value='{$h['id']}'>{$h['nom_hotel']}</option>";
                    }
                    ?>
                </select>

                <label for="sessions">Sessions :</label>
                <select name="sessions[]" id="sessions" multiple>
                    <?php
                    foreach ($sessions as $s) {
                        echo "<option value='{$s['id']}'>{$s['nom_session']}</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="btn">Enregistrer</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
            </form>
        </div>
    </div>
</body>
</html>
