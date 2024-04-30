<!-- admin.php -->

<form action="admin.php" method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>
  <br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>
  <br>
  <button type="submit">Login</button>
</form>

<?php

include 'database.php';


try {
    $myPDO = new PDO($dsn, $username, $pass);
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
  
      $sql = 'SELECT * FROM admin WHERE username = :username';
      $values = [':username' => $username];
  
      $sqlreference = $myPDO->prepare($sql);
      $sqlreference->execute($values);
  
      $result = $sqlreference->fetch();
  
      if ($result && password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['admin'] = $result['id_admin'];
        header('Location: backoffice.php');
      } else {
        echo 'Invalid username or password';
      }
    } else {
      echo 'Please enter a username and password';
    }
  
  } catch (PDOException $e) {
  
    echo 'MESSAGE: <br>'. $e->getMessage();
  
  }
  
  ?>