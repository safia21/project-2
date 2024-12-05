<?php
include '1dashboard.php'; // Inclusion du fichier contenant les données nécessaires
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Barre latérale défilante -->
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="profile/profile.php">Voir Profil</a>
        <a href="#graphiques">Statistiques</a>
        <a href="#services">Voir Services</a>
        <a href="#testimonials">Témoignages</a>
        <a href="#projets">Projets</a>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <!-- Barre de navigation avec le bouton Déconnexion -->
        <div class="navbar">
            <h1>Tableau de Bord</h1>
            <button class="logout-btn" onclick="logout()">Déconnexion</button>
        </div>

        <div class="welcome">
            <h2>Bienvenue, <?php echo "$prenom $nom"; ?> !</h2>
            <p>Nous sommes heureux de vous voir ici. Voici votre tableau de bord personnalisé.</p>
        </div>

        <!-- Section des graphiques -->
        <div class="charts-section" id="graphiques">
            <div class="chart-container">
                <div class="chart">
                    <canvas id="myLineChart"></canvas>
                </div>
                <div class="chart">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Section des services -->
        <h3>Services Disponibles</h3>
        <div class="services" id="services">
            <div class="service-box">
             <img src="img/computer-coding-svgrepo-com.svg" alt="Développement d'applications" class="service-image">
               <h4>DÉVELOPPEMENT D'APPLICATIONS MODULAIRES</h4>
                <p>Applications basées sur des principes OOP (Java, Python, C++).</p>
                <p>Architecture modulaire, évolutive et maintenable.</p>
            </div>
        <div class="service-box">
         <img src="img/teacher-svgrepo-com.svg" alt="Formation OOP" class="service-image">
           <h4>FORMATION EN PROGRAMMATION OOP</h4>
            <p>Cours sur les langages OOP.</p>
            <p>Coaching et bonnes pratiques.</p>
        </div>
        <div class="service-box">
           <img src="img/services-svgrepo-com.svg" alt="Intégration de microservices" class="service-image">
           <h4>INTÉGRATION DE MICROSERVICES OOP</h4>
           <p>Conception et déploiement de microservices OOP.</p>
        <p>Architecture décentralisée et évolutive.</p>
       </div>
       </div>

        <!-- Tableau des projets récents -->
        <h3>Projets Récents</h3>
        <div class="table-container" id="projets">
            <table>
                <tr>
                    <th>#</th>
                    <th>Nom du Projet</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Projet Alpha</td>
                    <td>Terminé</td>
                    <td>2024-11-10</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Projet Béta</td>
                    <td>En Cours</td>
                    <td>2024-11-12</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Projet Gamma</td>
                    <td>Non Démarré</td>
                    <td>2024-11-15</td>
                </tr>
            </table>
        </div>

        <!-- Section des témoignages -->
        <h3>Témoignages</h3>
        <div class="testimonials" id="testimonials">
            <div class="testimonial-box">
                <p>"Le service fourni est exceptionnel. Ils ont su répondre à toutes nos attentes et plus encore!"</p>
                <h4>Jean Dupont</h4>
                <p>Client satisfait</p>
            </div>
            <div class="testimonial-box">
                <p>"Une équipe professionnelle et réactive. Nous recommandons vivement leur expertise."</p>
                <h4>Marie Martin</h4>
                <p>Partenaire</p>
            </div>
            <div class="testimonial-box">
                <p>"Des résultats au-delà de nos espérances. Un partenariat précieux pour notre entreprise."</p>
                <h4>Lucien Lefevre</h4>
                <p>Collaborateur</p>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour la déconnexion
        function logout() {
            window.location.href = 'logout.php';
        }

        // Graphique en ligne (existante)
        const ctxLine = document.getElementById('myLineChart').getContext('2d');
        const myLineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai'],
                datasets: [{
                    label: 'Projets terminés',
                    data: [3, 5, 2, 8, 5],
                    borderColor: '#20c997',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3 // Courbe lisse
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique circulaire (nouveau)
        const ctxPie = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Terminé', 'En Cours', 'Non Démarré'],
                datasets: [{
                    label: 'Répartition des Projets',
                    data: [8, 5, 2],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    
</body>
</html>
