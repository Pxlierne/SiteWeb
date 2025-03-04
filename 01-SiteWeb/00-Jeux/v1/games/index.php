<?php
// Le code PHP reste inchangé
$directory = __DIR__;
if (!is_dir($directory)) {
    die("Le répertoire spécifié n'existe pas.");
}
$items = scandir($directory);
$folders = array_filter($items, function($item) use ($directory) {
    return is_dir($directory . '/' . $item) && $item !== '.' && $item !== '..';
});
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dossiers</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.2em;
            font-weight: 600;
        }
        .list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .folder {
            background: linear-gradient(145deg, #2980b9, #3498db);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .folder:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(145deg, #3498db, #2980b9);
        }
        .folder a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: 500;
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Dossiers</h1>
        <div class="list">
            <?php foreach ($folders as $folder): ?>
                <div class="folder" onclick="window.location='<?php echo htmlspecialchars('./' . $folder); ?>'">
                    <?php echo htmlspecialchars($folder); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($folders)): ?>
            <p>Aucun dossier trouvé dans le répertoire.</p>
        <?php endif; ?>
    </div>
</body>
</html>
