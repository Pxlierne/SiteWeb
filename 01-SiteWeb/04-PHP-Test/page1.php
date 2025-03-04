<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démo JavaScript</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e7e7e7;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Démo JavaScript</h1>
        
        <h2>1. Changement de texte</h2>
        <p id="changeMe">Cliquez sur le bouton pour changer ce texte.</p>
        <button onclick="changeText()">Changer le texte</button>

        <h2>2. Calcul simple</h2>
        <p>Entrez deux nombres pour les additionner :</p>
        <input type="number" id="num1" placeholder="Premier nombre">
        <input type="number" id="num2" placeholder="Deuxième nombre">
        <button onclick="addNumbers()">Additionner</button>
        <p id="sum"></p>

        <h2>3. Affichage de l'heure</h2>
        <p id="clock"></p>

        <h2>4. Contenu généré par PHP</h2>
        <?php
        $fruits = array("pomme", "banane", "orange", "fraise", "kiwi");
        echo "<ul>";
        foreach($fruits as $fruit) {
            echo "<li>$fruit</li>";
        }
        echo "</ul>";
        ?>

        <h2>5. Requête AJAX</h2>
        <button onclick="fetchData()">Charger des données</button>
        <div id="result"></div>
    </div>

    <script>
        function changeText() {
            document.getElementById("changeMe").innerHTML = "Le texte a été changé !";
        }

        function addNumbers() {
            var num1 = document.getElementById("num1").value;
            var num2 = document.getElementById("num2").value;
            var sum = parseInt(num1) + parseInt(num2);
            document.getElementById("sum").innerHTML = "La somme est : " + sum;
        }

        function updateClock() {
            var now = new Date();
            var clock = document.getElementById("clock");
            clock.innerHTML = "Heure actuelle : " + now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);

        function fetchData() {
            fetch('https://jsonplaceholder.typicode.com/todos/1')
                .then(response => response.json())
                .then(data => {
                    document.getElementById("result").innerHTML = "Titre de la tâche : " + data.title;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        }
    </script>
</body>
</html>
