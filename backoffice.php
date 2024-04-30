<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos obrigatórios foram fornecidos
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"]; 
        $image = $_POST["image"];
        $data_adicao = $_POST["date"];

        try {
            // Conecta ao banco de dados usando as informações do arquivo database.php
            $myPDO = new PDO($dsn, $username, $pass);
            $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $myPDO->prepare("INSERT INTO produto (nome, descricao, preco, quantidade,imagem,data_adicao) VALUES (:nome, :descricao, :preco, :quantidade, :imagem, :data_adicao)");
            $stmt->bindParam(':nome', $name);
            $stmt->bindParam(':descricao', $description);
            $stmt->bindParam(':preco', $price);
            $stmt->bindParam(':quantidade', $quantity);
            $stmt->bindParam(':imagem', $image);
            $stmt->bindParam(':data_adicao', $data_adicao);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erro ao inserir produto: ' . $e->getMessage();
        }
    
}
?>

<form action="add_product.php" method="post">
  <label for="name">Nome:</label>
  <input type="text" id="name" name="name" required>
  <br>
  <label for="description">Descrição:</label>
  *<input type="text" id="description" name="description" required>
  <br>
  <label for="price">Preço:</label>
  <input type="number" step="0.01" id="price" name="price" required>
  <br>
  <label for="quantity">Quantidade:</label>
  <input type="number" id="quantity" name="quantity" required>
  <br>
  <label for="image">Imagem:</label>
  <input type="text" id="image" name="image" required>
  <br>
  <label for="date">Data:</label>
  <input type="date" id="date" name="date" required>
  <br>
  <button type="submit">Adicionar Produto</button>
</form>

<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Preco</th>
      <th>Quantidade</th>
      <th>Fotos</th>
      <th>Data de criacao</th>
      <th>Acoes</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include 'database.php';

    try {
      $myPDO = new PDO($dsn, $username, $pass);
      $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = 'SELECT * FROM produtos';
      $result = $myPDO->query($sql);

      while ($row = $result->fetch()) {
        echo"<tr>";
        echo "<td>". htmlentities($row['nome']). "</td>";
        echo "<td>". htmlentities($row['descricao']). "</td>";
        echo "<td>". htmlentities($row['preco']). "</td>";
        echo "<td>". htmlentities($row['quantidade']). "</td>";
        echo "<td>". htmlentities($row['imagem']). "</td>";
        echo "<td>". htmlentities($row['data_adicao']). "</td>";
        echo "<td>";
        echo "<form action='delete_product.php' method='post'>";
        echo "<input type='hidden' name='id' value='". htmlentities($row['id']). "'>";
        echo "<button type='submit'>Apagar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }

    } catch (PDOException $e) {

      echo 'MESSAGE: <br>'. $e->getMessage();

    }
    
  ?>
  </tbody>
</table>
