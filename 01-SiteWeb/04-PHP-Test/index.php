<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Création de compte</h1>
    <form id="registerForm">
        <input type="text" id="username" placeholder="Nom d'utilisateur" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Mot de passe" required>
        <button type="submit">Créer un compte</button>
    </form>

    <div id="message"></div>

    <script>
    $(document).ready(function() {
        $("#registerForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'register.php',
                type: 'POST',
                data: {
                    username: $("#username").val(),
                    email: $("#email").val(),
                    password: $("#password").val()
                },
                success: function(response) {
                    $("#message").html(response);
                }
            });
        });
    });
    </script>
</body>
</html>
