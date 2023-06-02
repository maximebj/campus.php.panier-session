<?php 
    require_once "templates/header.php"; 
    require_once "functions/prices.php";
    require_once "functions/products.php";
    require_once "functions/alert.php";

    $products = getProducts();
?>
        
<h1>Tous les produits</h1>

<?php if (count($products) > 0): ?>
    <div class="shop">
        <?php foreach($products as $productKey => $product): ?>
            <div class="product">
                <img src="<?= $product['image'] ?>" alt="<?php echo $product["title"] ?>">
                <h2><?php echo $product['title'] ?></h2>
                <p><?php echo formatPrice(getPriceWithTax($product['price'])) ?></p>
                <p><?php echo $product['description'] ?></p>
                
                <form action="cart.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product" value="<?php echo $productKey ?>">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
                    
                    <?php if ($product["stock"] > 0): ?>
                        <button>Ajouter au panier</button>
                    <?php else: ?>
                        <button disabled>Produit indisponible</button>
                    <?php endif ?>
                </form>
            </div>
        <?php endforeach; ?>
    </div> <!-- fin shop -->

<?php else: ?>
    <p class="not-found">Aucun produit disponible</p>
<?php endif; ?>

<?php include "templates/footer.php" ?>