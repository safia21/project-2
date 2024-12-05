<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "SOA");

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jeton = $_POST['jeton'];
    $password = $_POST['mot_de_passe'];
    $confirm_password = $_POST['confirm_mot_de_passe'];

    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Vérifier si le token existe et est valide
    $sql = "SELECT email, date_expiration FROM reinitialisation_mot_de_passe WHERE jeton = '$jeton'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $date_expiration = $row['date_expiration'];

        // Vérifier si le lien n'est pas expiré
        if (strtotime($date_expiration) > time()) {
            $email = $row['email'];

            // Hasher le nouveau mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Mettre à jour le mot de passe
            $sql = "UPDATE utilisateurs SET mot_de_passe = '$hashed_password' WHERE email = '$email'";
            if ($conn->query($sql) === TRUE) {
                echo "Mot de passe réinitialisé avec succès.";
            }
        } else {
            echo "Le lien de réinitialisation a expiré.";
        }
    } else {
        echo "Token invalide.";
    }
}

$conn->close();
?>
