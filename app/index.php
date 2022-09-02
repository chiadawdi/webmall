<?php
require_once('header.php');?>
<div class="container">
    <div class="row">
    <div class="col-12 col-sm-11 col-md-8 col-lg-8 m-auto text-center shadow-sm rounded">
    <h3>All Products</h3>
</div>

   <div class="row bg-light shadow rounded text-dark rounded p-2 m-2 text-center"></div> 
<?php

if (checkRole()!=="admin") {
    $products=allData(" SELECT * FROM products ORDER BY id DESC");
foreach($products as $product){
$productid=$product['id'];
$productname=$product['productname'];
$productprice=$product['productprice'];
$productquantity=$product['productquantity'];

productscard($product);
}
}
?>
</div>
</div>

<?php

addToFavorite('index');
removeToFavorite('index');


?>
<?php require_once('Footer.php');?>