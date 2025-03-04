<?php
// Configuration de la base de données
$servername = "srv_mysql"; // Nom du service dans Docker Compose
$username = "root";
$password = "P@ssw0rd";
$dbname = "edcorp_db";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Traitement du formulaire d'ajout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['phonenumber'])) {
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];

    // Préparer et lier
    $stmt = $conn->prepare("INSERT INTO utilisateurs (username, phonenumber) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $phonenumber);
    
    if ($stmt->execute()) {
        echo "<p>User added successfully!</p>";
    } else {
        echo "<p>Error adding user: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

// Suppression d'un utilisateur
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM utilisateurs WHERE id=$id");
}

// Récupération et affichage des données
$result = $conn->query("SELECT * FROM utilisateurs");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - edcorp_ed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }
        .delete-btn:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Gérer les utilisateurs de la base de donnée edcorp_db</h2>

        <!-- Lien vers la page d'accueil -->
        <a href="../index.php">Retour à la page d'accueil</a>

        <h3>Ajout de nouveau utilisateur</h3>
        <form method="post" action="">
            <div class="form-group">
                <label>Nom:</label>
                <input type="text" name="username" required pattern="[A-Za-z0-9]+" title="Only alphanumeric characters allowed">
            </div>
            <div class="form-group">
                <label>Numéro de téléphone:</label>
                <input type="text" name="phonenumber" required pattern="[0-9]+" title="Only numbers allowed">
            </div>
            <input type="submit" name="submit" value="Ajouter">
        </form>

        <!-- Lien pour lancer le script de sauvegarde -->
        <h3>Actions</h3>
        <a href="run_backup.php" class="delete-btn" onclick="return confirm('Etes-vous sûr de vouloir lancer la sauvegarde ?')">Lancer la sauvegarde de la base de données</a>

        <h3>Liste des utilisateurs</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Numéro de téléphone</th>
                <th>Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                    <td><a href="?delete=<?php echo htmlspecialchars($row['id']); ?>" class="delete-btn" onclick="return confirm('Etes-vous sûr de vouloir supprimer l utilisateur?')">Supprimer</a></td>
                </tr>
            <?php endwhile; ?>

        </table>

        <?php if ($result->num_rows === 0): ?>
            <p>Aucun utilisateur trouvé dans la base de données.</p>
        <?php endif; ?>

    </div>

</body>
</html>

<?php
$conn->close(); // Ferme la connexion à la base de données.
?>
