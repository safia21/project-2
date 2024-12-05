<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <style>
        /* Réinitialisation des styles par défaut pour tous les éléments */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styles généraux pour le corps de la page */
        body {
            font-family: Arial, sans-serif; /* Police simple et lisible */
            background-color: #f4f7fa; /* Couleur d'arrière-plan douce */
            display: flex; /* Centrage vertical et horizontal */
            justify-content: center;
            align-items: center;
            height: 100vh; /* Hauteur de la fenêtre visible */
            margin: 0;
        }

        /* Styles pour le conteneur du formulaire */
        .container {
            background-color: #ffffff; /* Fond blanc pour le formulaire */
            padding: 30px; /* Espacement interne */
            border-radius: 8px; /* Coins arrondis */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Ombre douce */
            width: 100%; /* Largeur maximale */
            max-width: 400px; /* Largeur fixe maximale */
        }

        /* Styles pour le titre */
        h2 {
            text-align: center; /* Centrer le texte */
            color: #333; /* Couleur sombre */
            margin-bottom: 20px; /* Espacement sous le titre */
        }

        /* Styles pour les champs de saisie */
        .input-field {
            margin-bottom: 15px; /* Espacement entre les champs */
        }

        .input-field input {
            width: 100%; /* Largeur complète */
            padding: 12px; /* Espacement interne */
            border: 1px solid #ddd; /* Bordure grise */
            border-radius: 4px; /* Coins arrondis */
            font-size: 16px; /* Taille de police */
            outline: none; /* Retire le contour par défaut */
        }

        .input-field input:focus {
            border-color: #007bff; /* Couleur bleue pour le champ actif */
        }

        /* Styles pour le bouton d'envoi */
        .button input {
            width: 100%; /* Largeur complète */
            padding: 12px; /* Espacement interne */
            background-color: #007bff; /* Couleur de fond bleue */
            color: #fff; /* Texte blanc */
            border: none; /* Pas de bordure */
            border-radius: 4px; /* Coins arrondis */
            font-size: 16px; /* Taille de police */
            cursor: pointer; /* Curseur pointeur */
            transition: background-color 0.3s ease; /* Transition douce */
        }

        .button input:hover {
            background-color: #0056b3; /* Couleur plus sombre au survol */
        }

        /* Styles responsifs pour les petits écrans */
        @media (max-width: 600px) {
            .container {
                padding: 20px; /* Réduction de l'espacement interne */
            }

            h2 {
                font-size: 18px; /* Réduction de la taille du titre */
            }

            .input-field input {
                font-size: 14px; /* Réduction de la taille de police */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialiser votre mot de passe</h2>
        <!-- Formulaire de réinitialisation du mot de passe -->
        <form action="Envoyer_lien_de_réinitialisation.php" method="POST">
            <!-- Champ pour saisir l'adresse e-mail -->
            <div class="input-field">
                <input type="email" name="email" placeholder="Entrez votre e-mail" required>
            </div>
            <!-- Bouton pour soumettre le formulaire -->
            <div class="input-field button">
                <input type="submit" value="Envoyer le lien de réinitialisation">
            </div>
        </form>
    </div>
</body>
</html>
