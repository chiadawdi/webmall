<?php
require_once('header.php');

if (checkRole()=='admin') {
    redirect('index');
}

?>
<div class="container">
    <div class="row">
    <div class="col-12 col-sm-11 col-md-8 col-lg-8 m-auto text-center shadow-sm rounded">
    
    <h3>You Favorites </h3>
    <hr>
</div>

    <div class=" row bg-light shadow rounded text-dark rounded p-2 m-2 text-center">
    

<?php
$favorites=allData("SELECT * FROM favorites WHERE accountid='$authId'");
foreach ($favorites as $favorite) {
    $favoriteid=$favorite['id'];
    $productid=$favorite['productid'];
    $getproduct=findData("SELECT * FROM products WHERE id='{$productid}'");
    $productprice=$getproduct['productprice'];
    $productname=$getproduct['productname'];
    ?>

<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 text-center m-auto">

<div class="cart shadow-sm rounded p-2 m-1 ">
<div class="cart-header">
<img src="../assets/img/shop.png" alt="" class="cart-img" style="width:100%;height: 200px;">
<h4 class="cart-title"><?=$productname;?></h4>
</div>
<div class="cart-footer">
<h4 class="badge bg-info m-2 p-2" title="Price">$<?=$productprice;?></h4>
   <a href="index?removetofavorite=<?=$productid;?>" class="btn btn-danger m-1  btn-sm">
    <span class="fa fa-heart-circle-xmark" title="Remove From Favorite"></span>
</a>
<a href="orderform?productid=<?=$product['id'];?>"
    class="btn btn-warning m-1  btn-sm">
    <span class="fa fa-shopping-cart" title="Order"></span>
</a>
</div>
</div>
</div>
    <?php
}
?> 
</div>
</div>
<?php

addToFavorite('favorite');
removeToFavorite('favorite');
?>
<?php require_once('Footer.php');?>

