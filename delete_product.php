<?php
include 'database.php';

try {
  $myPDO = new PDO($dsn, $username, $pass);
  $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id = $_POST['id'];

  $sql = 'DELETE FROM produtos WHERE id = :id';
  $values = [':id' => $id];

  $sqlreference = $myPDO->prepare($sql);
  $sqlreference->execute($values);

  $mycount = $sqlreference->rowCount();
  echo "Number of records affected: $mycount";
  echo "<hr/>";

  echo "Product with ID $id has been deleted.";

} catch (PDOException $e) {

  echo 'MESSAGE: <br>'. $e->getMessage();

}

?>