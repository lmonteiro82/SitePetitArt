<?php
include 'database.php';

$pdo = new PDO($dsn, $username, $pass);

$message = '';


// Handle the login form submission

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
      
        $query = "SELECT * FROM cliente WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else {
            // Email ou senha incorretos
            $message = 'Email ou senha incorretos';
        }
}


?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="login.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> <!-- Adiciona o link para o arquivo style.css -->
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if ($message): ?>
            <p><?= $message; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Entrar">
        </form>
        <p>Não tem conta? <a class="link" href="registro.php">Registre-se aqui</a></p>
    </div>
</body>
</html>

