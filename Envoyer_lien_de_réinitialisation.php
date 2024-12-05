<?php
include 'mot_de_passe_oublier.php';

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "SOA");

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Vérifier si l'email existe
    $sql = "SELECT id FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Générer un jeton unique
        $jeton = bin2hex(random_bytes(50)); 
        $date_expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Lien valable 1 heure

        // Insérer le jeton dans la base de données
        $sql = "INSERT INTO reinitialisation_mot_de_passe (email, jeton, date_expirationa) VALUES ('$email', '$jeton', '$date_expiration')";
        if ($conn->query($sql) === TRUE) {
            // Envoyer un e-mail avec le lien de réinitialisation
            $reset_link = "http://localhost/Réinitialiser_mot_de_passe.php?jeton=" . $jeton;

            $subject = "Réinitialisation de votre mot de passe";
            $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe: $reinitial_lien";
            $headers = "From: no-reply@soa.com";

            mail($email, $subject, $message, $headers);
            echo "Un e-mail a été envoyé avec le lien de réinitialisation.";
        }
    } else {
        echo "   Aucun compte trouvé pour cet e-mail.";
    }
}

$conn->close();
?>
