<?php

include 'database.php';

$myPDO = new PDO($dsn, $username, $pass);
$myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the form data
    $errors = [];
    if (empty($_POST['nome'])) {
        $errors[] = 'O nome é obrigatório.';
    }
    if (empty($_POST['email'])) {
        $errors[] = 'O email é obrigatório.';
    }
    if (empty($_POST['senha'])) {
        $errors[] = 'A senha é obrigatória.';
    }

    // If there are no errors, check if the user or email already exists
    if (empty($errors)) {
        $stmt = $myPDO->prepare('SELECT * FROM cliente WHERE nome = :nome OR email = :email');
        $stmt->execute(['nome' => $_POST['nome'], 'email' => $_POST['email']]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            $errors[] = 'Usuário ou email já existem.';
        } else {
            // Hash the password
            $password = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            // Insert the client into the database
            $stmt = $myPDO->prepare('INSERT INTO cliente (nome, email, password) VALUES (:nome, :email, :password)');
            $stmt->execute(['nome' => $_POST['nome'], 'email' => $_POST['email'], 'password' => $password]);

            // Redirect the user to the login page
            header('Location: login.php');
            exit;
        }
    }
}


// Display the registration form
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="login.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> <!-- Adiciona o link para o arquivo style.css -->
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <?php if (isset($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post">
            <label for="nome" style="display: block;">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" style="display: block;">

            <label for="email" style="display: block;">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" style="display: block;">

            <label for="senha" style="display: block;">Senha:</label>
            <input type="password" name="senha" id="senha" style="display: block;">

            <button type="submit" style="margin-top: 5px;">Registrar</button>
            <p>Já tem uma conta? <a href="login.php">Entre aqui</a></p>
        </form>
    </div>
</body>
</html>

