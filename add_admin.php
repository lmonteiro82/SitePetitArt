// add_admin.php

<?php

include 'database.php';

try {
  $myPDO = new PDO($dsn, $username, $pass);
  $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $username = 'monica';
  $password = password_hash('monica', PASSWORD_DEFAULT);

  $sql = 'INSERT INTO admin (username, password) VALUES (:username, :password)';
  $values = [':username' => $username, ':password' => $password];

  $sqlreference = $myPDO->prepare($sql);
  $sqlreference->execute($values);

  echo "Admin added successfully";

} catch (PDOException $e) {

  echo 'MESSAGE: <br>'. $e->getMessage();

}

?>