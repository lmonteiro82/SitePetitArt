<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['imagem']?>" width="500" height="500" alt="<?=$product['nome']?>">
    <div>
        <h1 class="name"><?=$product['nome']?></h1>
        <span class="price">
            &euro;<?=$product['preco']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&euro;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantidade" value="1" min="1" max="<?=$product['quantidade']?>" placeholder="Quantidade" required>
            <input type="hidden" name="id" value="<?=$product['id']?>">
            <input type="submit" value="Adicionar ao carrinho">
        </form>
        <div class="description">
            <?=$product['descricao']?>
        </div>
    </div>
</div>

<?=template_footer()?>