<?php 
    include "templates/header.php"; 
    include "functions/prices.php";
    include "functions/products.php";

    // Qu'est-ce qu'on récupère du formulaire ? 
    // print_r($_POST);

    // Sécurité : on vérifie que les données sont bien présentes
    if ( !isset($_POST['product']) || !isset($_POST['quantity']) ) {
        header('Location: index.php');
        exit;
    }

    // On récupère le produit
    $productKey = $_POST['product'];
    $product = getProduct($productKey);
    $quantity = (int) $_POST['quantity'];

    // Sécurité : on vérifie maintenant que le produit est bien en stock
    if (! $product['available']) {
        header('Location: index.php');
        exit;
    }

    // On calcule le total 
    $total = $product['price'] * $quantity;
?>
        
<h1>Panier</h1>

<form action="cart.php" method="POST">
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
            <tr>
                <td><?php echo $product['title'] ?></td>
                <td>
                    <input type="hidden" name="product" value="<?php echo $productKey ?>">
                    <input type="number" name="quantity" value="<?php echo $quantity ?>" min="1">
                </td>
                <td><?php echo formatPrice(getPriceWithTax($product['price'])) ?></td>
                <td><?php echo formatPrice(getPriceWithTax($total)) ?></td>
            </tr>
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

<?php include "templates/footer.php"; ?>