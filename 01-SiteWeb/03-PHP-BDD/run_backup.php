<?php
// Chemin vers le script de sauvegarde
$backupScript = './BDD_Backup.sh';

// Exécuter le script
$output = [];
$return_var = 0;

exec("bash $backupScript", $output, $return_var);

// Vérifiez si l'exécution a réussi
if ($return_var === 0) {
    echo "<p>Script lancé !</p>";
} else {
    echo "<p>Erreur lors de la sauvegarde.</p>";
}

// Afficher la sortie du script
echo "<pre>" . implode("\n", $output) . "</pre>";
?>
