<?php
require_once('header.php');

if (checkRole()=='admin') {
    redirect('index');
}
$productId=request($_GET['id']);
$sql="SELECT * FROM products WHERE id='{$productId}'";
$getproduct=findData("$sql");
$checkproduct=countData("$sql");
if ($checkproduct === 0) {
    redirect('index');
}
?>
<div class="container">

<div class="row bg-light shadow rounded  text-dark rounded p-2 text-center mt-2">
<button class="btn btn-info text-light p-1 m-1"  style="width:40px;"
 onclick="window.history.back()" title="Print">
<span class="fa fa-arrow-left"></span></button>
<div class="col-12 col-sm-112 col-md-12 col-lg-12 m-auto text-center">



<h3> Product Title</h3>
<hr>
</div>

<div class="col-11 col-sm-11 col-md-6 col-lg-4 col-xl-4 m-auto text-center mt-2  p-2 rounded">
<img src="../assets/img/shop.png" alt="" class="cart-img" style="width:100%;height: 200px;object-fit:contain">
</div>
<div class="col-11 col-sm-11 col-md-6 col-lg-8 col-xl-8 m-auto  text-center   p-2 rounded mt-5">
<h4>Price:$ <?=$getproduct['productprice'];?></h4>
<h4>Quantity:<?=$getproduct['productquantity'];?> PCS</h4>
<p>Detail :</p>
<p>.......</p>
</div>
<div class="footer">

<?php

    if (checkfavoriteIfAlreadyExist($getproduct['id'])) {
    
    ?>
       <a href="productdetail?removetofavorite=<?=$getproduct['id'];?>&id=<?=$getproduct['id'];?>"
        class="btn btn-danger m-1  btn-sm">
        <span class="fa fa-heart-circle-xmark" title="Remove From Favorite"></span>
    </a>
    <?php
    }
    else {
    ?>
       <a href="productdetail?addtofavorite=<?=$getproduct['id'];?>&id=<?=$getproduct['id'];?>"
        class="btn btn-success m-1  btn-sm">
        <span class="fa fa-heart-circle-plus" title="Add To Favorite"></span>
    </a>
    <?php
}
?>
    <a href="orderform?productid=<?=$getproduct['id'];?>&id=<?=$getproduct['id'];?>"
    class="btn btn-warning m-1  btn-sm">
    <span class="fa fa-shopping-cart" title="Order"></span>
</a>
<?php
?>
</div>
</div>
</div>
<?php

addToFavorite('productdetail');
removeToFavorite('productdetail');

?>
<?php
require_once('Footer.php');?>