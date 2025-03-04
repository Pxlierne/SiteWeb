<?php
function asset($path) {
    return '/00-Jeux/v1/assets/' . ltrim($path, '/');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Collection de Jeux Flash') ?></title>
    <link rel="stylesheet" href="<?= asset('css/critical.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <!--<script src="https://unpkg.com/@ruffle-rs/ruffle" defer></script>-->
    <script src="<?= asset('js/ruffle/ruffle.js') ?>" defer></script>
    <script src="<?= asset('js/ruffle-loader.js') ?>" defer></script>
    <script src="<?= asset('js/main.js') ?>" defer></script>
</head>
<body>
    <header>
        <img src="<?= asset('images/ui/logo.webp') ?>" alt="Logo">
        <nav>
            <ul>
                <li><a href="/00-Jeux/v1/">Accueil</a></li>
                <li><a href="/00-Jeux/v1/includes/leaderboard.php">Classements</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
