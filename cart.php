<?php
    session_start();

    require_once "functions/prices.php";
    require_once "functions/cart.php";
    require_once "functions/alert.php";

    // On vérifie si un élément a été ajouté au panier
    // Maintenant qu'on a une session, on peut consulter le panier à tout moment sans forcément ajouter/supprimer un élément 
    if ( isset($_POST['product']) && isset($_POST['quantity']) && isset($_POST['action']) ) {
        $productKey = $_POST['product'];
        $quantity = $_POST['quantity'];
        $action = $_POST['action'];

        if ($action === "add") {
            addToCart($productKey, $quantity);
        }

        if ($action === "update") {
            updateCart($productKey, $quantity);
        }   
    }

    // On vérifie si on doit supprimer un produit
    if (isset($_GET['delete'])){
        $productKey = $_GET['delete'];
        removeFromCart($productKey);
    }

    // On va récupérer le panier (avec info produits et quantités)
    $cart = getCart();

    // On calcule le total
    $total = getCartTotal($cart);

    // On commence l'affichage du HTML
    $title = "Panier";
    require_once "templates/header.php"; 
?>
        
<h1>Panier</h1>

<?php if (isset($_GET['delete'])): ?>
    <?php echo getAlert( 'Le produit <strong>' . $_GET['delete'] . '</strong> a été supprimé de votre panier.', 'error'); ?>
<?php endif; ?>

<p class="back">
    <a href="index.php">← Continuer mes achats</a>
</p>

<?php if( empty($cart)): ?>
    <?php echo getAlert('Votre panier est vide.', 'success'); ?>
<?php else: ?>

    <form action="cart.php" method="POST">
        <input type="hidden" name="action" value="update">
        <table>
            <thead>
                <tr>
                    <th>Désignation</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart as $item): ?>
                    <tr>        
                        <td><?php echo $item['title'] ?></td>
                        <td>
                            <input type="hidden" name="product[]" value="<?php echo $item['id'] ?>">
                            <input type="number" name="quantity[]" value="<?php echo $item['quantity'] ?>" min="1" max="<?php echo $item['stock'] ?>">
                            <a href="cart.php?delete=<?php echo $item['id'] ?>" class="delete">×</a>
                        </td>
                        <td><?php echo formatPrice(getPriceWithTax($item['price'])) ?></td>
                        <td><?php echo formatPrice(getPriceWithTax($item['total'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <button>Mettre à jour le panier</button>
                    </td>
                    <td>Total HT</td>
                    <td><?php echo formatPrice($total) ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Dont TVA</td>
                    <td><?php echo formatPrice(getTaxFromPrice($total)) ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Total TTC</td>
                    <td><?php echo formatPrice(getPriceWithTax($total)) ?></td>
                </tr>
            </tfoot>
        </table>
    </form>

<?php endif; ?>

<?php include "templates/footer.php"; ?>