<?php
session_start();

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "SOA");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['mot_de_passe'];

    // Requête pour vérifier si l'email existe dans la base de données
    $sql = "SELECT id, mot_de_passe FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($sql);

    // Si un utilisateur avec cet email existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Vérification du mot de passe
        if (password_verify($password, $row['mot_de_passe'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: indx.html?error=wrong_password");
            exit();
        }
    } else {
        header("Location: indx.html?error=email_not_found");
        exit();
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
