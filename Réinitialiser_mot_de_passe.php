<?php
if (!isset($_GET['jeton'])) {
    die("Jeton manquant.");
}

$token = $_GET['jeton'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Réinitialiser votre mot de passe</h2>
        <form action="mise_a_jour_mot_de_passe.php" method="POST">
            <input type="hidden" name="jeton" value="<?php echo $jeton; ?>">
            <div class="input-field">
                <input type="password" name="mot_de_passe" placeholder="Nouveau mot de passe" required>
            </div>
            <div class="input-field">
                <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
            </div>
            <div class="input-field button">
                <input type="submit" value="Réinitialiser le mot de passe">
            </div>
        </form>
    </div>
</body>
</html>
