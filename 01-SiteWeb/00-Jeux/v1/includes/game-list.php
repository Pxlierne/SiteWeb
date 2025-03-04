<?php
$swfDir = dirname(__DIR__) . '/swf/';
$swfFiles = glob($swfDir . '*.swf');

$games = [];

foreach ($swfFiles as $swf) {
    $fileName = pathinfo($swf, PATHINFO_FILENAME);
    $title = htmlspecialchars(ucwords(str_replace('-', ' ', $fileName)));
    $thumbPath = asset("images/game-thumbnails/{$fileName}.webp");

    if (!file_exists(dirname(__DIR__) . "/assets/images/game-thumbnails/{$fileName}.webp")) {
        $thumbPath = asset("images/game-thumbnails/default.webp");
    }

    $games[] = [
        'title' => $title,
        'file' => basename($swf),
        'thumb' => $thumbPath
    ];
}

echo '<div class="game-grid">';
foreach ($games as $game) {
    echo "<a href='games/games.php?game={$game['file']}' class='game-card'>";
    echo "<img src='{$game['thumb']}' alt='{$game['title']}' loading='lazy'>";
    echo "<span>{$game['title']}</span>";
    echo "</a>";
}
echo '</div>';
?>
