<?php

$cArticulos = $_GET['cArticulos'];
$p = $_GET['p'];

if (isset($_GET['comprar'])){
    
    header("location:buy_products.php?cArticulos=" . $cArticulos . "&p=" . $p);
}

if(isset($_GET['carrito'])){
    header("location:add_cart.php?cArticulos=" . $cArticulos . "&p=" . $p);
}

?>