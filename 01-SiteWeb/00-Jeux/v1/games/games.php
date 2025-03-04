<?php
$pageTitle = "Jeux Flash";
include_once __DIR__ . '/../header.php';

$swfDir = dirname(__DIR__) . '/swf/';
$swfFiles = glob($swfDir . '*.swf');

if (isset($_GET['game'])) {
    $currentGame = basename($_GET['game']);
    if (file_exists($swfDir . $currentGame) && pathinfo($currentGame, PATHINFO_EXTENSION) === 'swf') {
        $gameName = pathinfo($currentGame, PATHINFO_FILENAME);
        ?>
        <h1><?= htmlspecialchars(ucfirst(str_replace('-', ' ', $gameName))) ?></h1>
        <div id="game-container"></div>
        <div class="game-controls">
            <button class="fullscreen-button" id="fullscreen-button">Plein Écran</button>
            <button class="mute-button" id="mute-button">Couper le Son</button>
        </div>
        <script>
        function calculateGameSize() {
            const width = Math.min(window.innerWidth * 0.9, 1024);
            const height = Math.min(window.innerHeight * 0.8, 768);
            return { width, height };
        }

        document.addEventListener('DOMContentLoaded', () => {
            const gameSize = calculateGameSize();
            const container = document.getElementById('game-container');
            container.style.width = gameSize.width + 'px';
            container.style.height = gameSize.height + 'px';

            if (typeof loadGame === 'function') {
                loadGame('<?= $currentGame ?>', gameSize.width, gameSize.height);
            } else {
                console.error('loadGame is not defined');
            }

            const fullscreenButton = document.getElementById('fullscreen-button');
            fullscreenButton.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    container.requestFullscreen().catch(err => {
                        console.error(`Error attempting to enable full-screen mode: ${err.message}`);
                    });
                } else {
                    document.exitFullscreen();
                }
            });

            const muteButton = document.getElementById('mute-button');
            muteButton.addEventListener('click', () => {
                const player = document.querySelector('ruffle-player');
                if (player) {
                    player.muted = !player.muted;
                    muteButton.textContent = player.muted ? 'Activer le Son' : 'Couper le Son';
                }
            });

            window.addEventListener('resize', () => {
                const newSize = calculateGameSize();
                container.style.width = newSize.width + 'px';
                container.style.height = newSize.height + 'px';
                // Vous devrez peut-être implémenter une fonction pour redimensionner le jeu ici
            });
        });
        </script>
        <?php
    } else {
        echo "<p>Le jeu demandé n'existe pas ou n'est pas un fichier SWF valide.</p>";
    }
} else {
    ?>
    <h1>Liste des jeux disponibles</h1>
    <ul class="game-list">
    <?php foreach ($swfFiles as $swf): ?>
        <?php
        $gameName = pathinfo($swf, PATHINFO_FILENAME);
        $displayName = htmlspecialchars(ucfirst(str_replace('-', ' ', $gameName)));
        ?>
        <li><a href="?game=<?= htmlspecialchars(basename($swf)) ?>"><?= $displayName ?></a></li>
    <?php endforeach; ?>
    </ul>
    <?php
}

include_once __DIR__ . '/../footer.php';
?>
