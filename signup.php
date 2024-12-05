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
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['mot_de_passe'];

    // Vérification de l'email
    $check_email_query = "SELECT id FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($check_email_query);
    
    if ($result->num_rows > 0) {
        header("Location: indx.html?error=email_exists");
        exit();
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertion dans la base de données
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) 
            VALUES ('$nom', '$prenom', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['id'] = $conn->insert_id;
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: indx.html?error=signup_failed");
        exit();
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
