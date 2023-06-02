<?php 

function formatPrice($price, $currency = "€") {
    return number_format($price / 100, 2, ',', ' ') . " " . $currency;
}

function getPriceWithTax($price, $tax = 20) {
    return $price * (1 + $tax/100);
}

function getTaxFromPrice($price, $tax = 20) {
    return $price * ($tax/100);
}