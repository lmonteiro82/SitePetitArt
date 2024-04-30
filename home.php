<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM produtos ORDER BY data_adicao DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

<div class="featured">
    <h2>PetitArt</h2>
    <p>Artesanato para si</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Produtos Recentes</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['imagem']?>" width="200" height="200" alt="<?=$product['nome']?>">
            <span class="name"><?=$product['nome']?></span>
            <span class="price">
                &euro;<?=$product['preco']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&euro;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>
<body class="background-image">


<?=template_footer()?>
