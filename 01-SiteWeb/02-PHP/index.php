<?php
// Définir le fuseau horaire
date_default_timezone_set('Europe/Paris');

// Obtenir la date et l'heure actuelles
$currentDateTime = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Bienvenue sur ma page PHP</h1>
    <p>Ceci est une page PHP de test pour vérifier que votre serveur fonctionne correctement.</p>
    <p>Date et heure actuelles : <?php echo $currentDateTime; ?></p>
    <p><a href="../index.php">Retour à la page d'acceuil</a></p>
</body>
</html>
