<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Utilisateur non connecté.'
    ]);
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SOA";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur de connexion à la base de données : ' . $conn->connect_error
    ]);
    exit();
}

// Récupérer les données envoyées par AJAX
$ancien_mdp = $_POST['ancien_mdp'] ?? '';
$nouveau_mdp = $_POST['nouveau_mdp'] ?? '';
$confirmer_mdp = $_POST['confirmer_mdp'] ?? '';

// Vérifiez que les champs sont remplis
if (empty($ancien_mdp) || empty($nouveau_mdp) || empty($confirmer_mdp)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Tous les champs sont requis.'
    ]);
    exit();
}

// Vérifiez si le nouveau mot de passe correspond à la confirmation
if ($nouveau_mdp !== $confirmer_mdp) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Le nouveau mot de passe et la confirmation ne correspondent pas.'
    ]);
    exit();
}

// Récupérez l'utilisateur depuis la base de données
$user_id = $_SESSION['id'];
$sql = "SELECT mot_de_passe FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Utilisateur introuvable.'
    ]);
    exit();
}

$user = $result->fetch_assoc();

// Vérifiez si l'ancien mot de passe est correct
if (!password_verify($ancien_mdp, $user['mot_de_passe'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'L\'ancien mot de passe est incorrect.'
    ]);
    exit();
}

// Hash du nouveau mot de passe
$nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

// Mettez à jour le mot de passe dans la base de données
$update_sql = "UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("si", $nouveau_mdp_hash, $user_id);

if ($update_stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Mot de passe mis à jour avec succès.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur lors de la mise à jour du mot de passe : ' . $conn->error
    ]);
}

$conn->close();
?>
