<?php
$pageTitle = "Classements";
$rootPath = dirname(__DIR__);
include_once $rootPath . '/header.php';

// Simuler des données de classement (à remplacer par une vraie base de données)
$leaderboard = [
    ['name' => 'Joueur1', 'score' => 1000],
    ['name' => 'Joueur2', 'score' => 950],
    ['name' => 'Joueur3', 'score' => 900],
];
?>

<main>
    <h1>Classements</h1>
    <table>
        <tr><th>Rang</th><th>Nom</th><th>Score</th></tr>
        <?php foreach ($leaderboard as $index => $player): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($player['name']) ?></td>
                <td><?= $player['score'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include_once $rootPath . '/footer.php'; ?>
