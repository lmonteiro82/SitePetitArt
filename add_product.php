<?php
include 'database.php';

try {
  $myPDO = new PDO($dsn, $username, $pass);
  $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $nome = $_POST['name'];
  $descricao = $_POST['description'];
  $preco = $_POST['price'];
  $quantidade = $_POST['quantity'];
  $imagem = $_POST['image'];
  $data_adicao = $_POST['date'];

  $sql = 'INSERT INTO produtos(nome,descricao,preco,quantidade,imagem,data_adicao) VALUES(:nome,:descricao,:preco,:quantidade,:imagem,:data_adicao)';
  $values = [':nome' => $nome, ':descricao' => $descricao, ':preco' => $preco, ':quantidade' => $quantidade, ':imagem' => $imagem, ':data_adicao' => $data_adicao];

  $sqlreference = $myPDO->prepare($sql);
  $sqlreference->execute($values);
  $lastid = $myPDO->lastInsertId();

  echo "last id: $lastid";

  $lastRecord = $myPDO->query("SELECT * FROM produtos WHERE id=$lastid");

  while ($row = $lastRecord->fetch()) {
    echo "<strong>". htmlentities($row['nome']). "</strong>". " foi adicionado";
  }

} catch (PDOException $e) {

  echo 'MESSAGE: <br>'. $e->getMessage();

}

?>