<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Congressiste</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Congressiste</h1>
        <form action="../controllers/CongressisteController.php" method="POST">
            <input type="hidden" name="action" value="add">
            <label for="nom_congre">Nom :</label>
            <input type="text" name="nom_congre" id="nom_congre" required>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" required>
            <label for="tel">Téléphone :</label>
            <input type="text" name="tel" id="tel">
            <label for="date_inscription">Date d'inscription :</label>
            <input type="date" name="date_inscription" id="date_inscription" required>

            <label for="num_organisme">Organisme :</label>
            <select name="num_organisme" id="num_organisme">
                <?php
                require_once '../classes/Database.php';
                $database = new Database();
                $conn = $database->getConnection();
                $stmt = $conn->query("SELECT id, nom FROM organisme");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nom']}</option>";
                }
                ?>
            </select>

            <label for="num_hotel">Hôtel :</label>
            <select name="num_hotel" id="num_hotel">
                <?php
                $stmt = $conn->query("SELECT id, nom_hotel FROM hotel");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nom_hotel']}</option>";
                }
                ?>
            </select>

            <label for="sessions">Sessions :</label>
            <select name="sessions[]" id="sessions" multiple>
                <?php
                $stmt = $conn->query("SELECT id, nom_session FROM session");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nom_session']}</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="window.location.href='list_congressistes.php'">Annuler</button>
        </form>
    </div>
</body>
</html>
