<?php 

include "functions/products.php";

function addToCart($productKey, $quantity) {
    
    $product = getProduct($productKey);
    
    // On ne fait rien si le produit n'est pas en stock
    if ($product['stock'] === 0 || $product['stock'] < $quantity) {
        return;
    }

    // On initialise le tableau de session s'il n'existe pas encore
    if (! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // On ajoute (ou remplace) le produit au panier
    if (isset($_SESSION['cart'][$productKey])) {
        $_SESSION['cart'][$productKey] += $quantity;
    } else {
        $_SESSION['cart'][$productKey] = $quantity;
    }
}

function getCart() {
    $cartSession = $_SESSION['cart'] ?? [];

    // Equivaut à 
    // $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Ou encore à 
    // if( isset($_SESSION['cart']) ) {
    //     $cart = $_SESSION['cart'];
    // } else {
    //     $cart = [];
    // }

    $cart = [];

    foreach($cartSession as $productKey => $quantity) {
        
        $product = getProduct($productKey);

        $cart[$productKey] = [
            'id'        => $productKey,
            'title'     => $product['title'],
            'stock'     => $product['stock'],
            'price'     => $product['price'],
            'quantity'  => $quantity,
            'total'     => $product['price'] * $quantity,
        ];
    }

    return $cart;
}

function getCartTotal($cart) {
    $total = 0;

    foreach($cart as $item) {
        $total += $item['total'];
    }

    return $total;
}

function getCartItems() {
    if ( ! isset($_SESSION['cart']) ) {
        return 0;
    }

    return count($_SESSION['cart']);
}

function updateCart($productKeys, $quantities) {
    for($i = 0; $i< count($productKeys); $i++) {

        $productKey = $productKeys[$i];
        $product = getProduct($productKey);
        $quantity = $quantities[$i];

        // On ne fait rien si le produit n'est pas en stock
        if ($product['stock'] === 0 || $product['stock'] < $quantity ) {
            return;
        }
        
        // On ajoute (ou remplace) le produit au panier
        $_SESSION['cart'][$productKey] = $quantity;
    }
}

function removeFromCart($productKey) {

    if(! isset($_SESSION['cart'][$productKey])) {
        return;
    }

    unset($_SESSION['cart'][$productKey]);
}