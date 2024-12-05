<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: indx.html"); // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "SOA");

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérez l'ID de l'utilisateur depuis la session
$userId = $_SESSION['id'];

// Préparez une requête pour récupérer le prénom et le nom
$sql = "SELECT prenom, nom FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $prenom = htmlspecialchars($row['prenom']);
    $nom = htmlspecialchars($row['nom']);
} else {
    // Si aucun utilisateur trouvé, déconnectez la session
    session_destroy();
    header("Location: indx.html");
    exit();
}

$stmt->close();
$conn->close();
?>
