<?php 
    include_once "functions/cart.php";

    $cartCount = getCartItems();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="header">
        <a href="index.php">Ma boutique</a>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="cart.php">Mon Panier (<?php echo $cartCount ?> items)</a>
        </nav>
    </header>

    <div class="page">