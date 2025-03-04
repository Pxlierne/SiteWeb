
console.log('ruffle-loader.js is loaded');

function loadGame(swfFile) {
    console.log('Loading game:', swfFile);
    const container = document.getElementById('game-container');
    if (!container) {
        console.error('Game container not found');
        return;
    }

    if (window.RufflePlayer) {
        console.log('RufflePlayer is defined');
        const ruffle = window.RufflePlayer.newest();
        if (ruffle) {
            console.log('Ruffle instance created:', ruffle);
            const player = ruffle.createPlayer();
            console.log('Player instance:', player);

            // Ajoutez l'élément Ruffle au conteneur avant de charger le jeu
            container.appendChild(player);

            player.load(`../swf/${swfFile}`).then(() => {
                console.log('Game loaded successfully');
            }).catch((error) => {
                console.error('Failed to load game:', error);
            });
        } else {
            console.error('Failed to create Ruffle instance');
        }
    } else {
        console.error('RufflePlayer is not defined. Ensure Ruffle is loaded correctly.');
    }
}