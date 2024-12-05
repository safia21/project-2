<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: http://localhost/Tp%20login-signup%20php/indx.html"); // Redirigez vers une page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SOA";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupération des données de l'utilisateur
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Vérification si l'utilisateur existe
if ($result->num_rows === 0) {
    echo "Utilisateur non trouvé.";
    exit();
}

$user = $result->fetch_assoc();

// Modification des données de l'utilisateur si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);

    $update_sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $nom, $prenom, $email, $user_id);

    if ($update_stmt->execute()) {
        echo "Profil mis à jour avec succès!";
        // Actualisez les données pour refléter les modifications
        $user['nom'] = $nom;
        $user['prenom'] = $prenom;
        $user['email'] = $email;
    } else {
        echo "Erreur lors de la mise à jour: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="profile-container">
        <button class="back-button" onclick="window.history.back();">Retour</button>
        <h1>Profil Utilisateur</h1>

        <!-- Affichage des informations de l'utilisateur -->
        <p><strong>Nom:</strong> <?php echo $user['nom']; ?></p>
        <p><strong>Prénom:</strong> <?php echo $user['prenom']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

        <!-- Message de retour -->
        <?php if (!empty($message)): ?>
            <div class="<?php echo strpos($message, 'succès') !== false ? 'success-message' : 'error-message'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Modifier les informations</h2>
        <form method="post" action="">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>" required><br>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

            <button id="parametre_simple"type="submit">Mettre à jour</button>
        </form>
       
        <h2>Modifier le mot de passe</h2>
<form id="passwordForm">
    <label for="ancien_mdp">Ancien Mot de Passe:</label>
    <input type="password" id="ancien_mdp" name="ancien_mdp" required><br>

    <label for="nouveau_mdp">Nouveau Mot de Passe:</label>
    <input type="password" id="nouveau_mdp" name="nouveau_mdp" required><br>

    <label for="confirmer_mdp">Confirmer le Nouveau Mot de Passe:</label>
    <input type="password" id="confirmer_mdp" name="confirmer_mdp" required><br>

    <button type="submit">Mettre à jour</button>
</form>
//ajouter les scripts ici
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#passwordForm').on('submit', function(e) {
        e.preventDefault(); // Empêche le rechargement de la page
        
        // Envoi de la requête AJAX
        $.ajax({
            url: 'update_password.php', // Fichier de traitement côté serveur
            method: 'POST', // Méthode HTTP
            data: $(this).serialize(), // Sérialise les données du formulaire
            dataType: 'json', // Format de la réponse attendue
            success: function(response) {
                alert(response.message); // Affiche le message de réponse
                if (response.status === 'success') {
                    $('#passwordForm')[0].reset(); // Réinitialise le formulaire si succès
                }
            },
            error: function() {
                alert("Une erreur est survenue."); // Message en cas d'erreur serveur
            }
        });
    });
});
</script>



    </div>
</body>
</html>

