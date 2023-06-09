<?php 

function getProducts() {
    return [
        "ipad" => [
            "title" => "iPad",
            "price" => 45000,
            "description" => "La tablette qui prend la poussière",
            "image" => "img/ipad.jpeg",
            "stock" => 12,
        ],
        "iphone" => [
            "title" => "iPhone",
            "price" => 100000,
            "description" => "Le téléphone hors de prix",
            "image" => "img/iphone.webp",
            "stock" => 50,
        ],
        "macbook" => [
            "title" => "Macbook Pro",
            "price" => 240000,
            "description" => "L'ordinateur du turfu",
            "image" => "img/macbook.jpeg",
            "stock" => 0,
        ]
    ];
}

function getProduct($key)
{
    $products = getProducts();

    if ( !isset($products[$key]) ) {
        throw new Exception("Le produit $key n'existe pas");
    }

    return $products[$key];
}