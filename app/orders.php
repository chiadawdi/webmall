<?php
require_once('header.php');

if (checkRole()=='admin') {
    redirect('index');
}

?>
<div class="container">
    <div class="row">
    <div class="col-12 col-sm-11 col-md-8 col-lg-8 m-auto text-center shadow-sm rounded">
    <h3>You Orders </h3>
</div>

    <div class="row bg-light shadow rounded text-dark rounded p-2 m-2 text-center">
<table class="table table-hover table-bordered text-center">

<thead>
    <tr>
        <th>Product</th>
        <th>Price / $</th>
        <th>Qty / PCS</th>
        <th>Amount / $</th>
        <th>Order Number</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>
    <?php
    $total=0;
$orders=allData("SELECT * FROM orders WHERE accountid='$authId' ORDER BY id DESC");
foreach ($orders as $favorite) {
$favoriteid=$favorite['id'];
$productid=$favorite['productid'];
$price=$favorite['price'];
$qty=$favorite['qty'];
$amount=$favorite['amount'];
$number=$favorite['number'];
$date=$favorite['date'];
$getproduct=findData("SELECT * FROM products WHERE id='{$productid}'");
$productname=$getproduct['productname'];
$total=$total+$amount;
?>
<tr>
    <td><?=$productname;?></td>
    <td> $<?=$price;?></td>
    <td><?=$qty;?></td>
    <td>$<?=$amount;?></td>
    <td><span class="badge bg-primary" >#<?=$number;?></span></td>
    <td><?=$date;?></td>
    

    

</tr>
<?php
}
?>
<tr>
    <th>Total</th>
    <th><?=$total;?></th>
</tr>
</tbody>
</table>
<button class="btn btn-info btn-lg p-1 m-1 " onclick="window.print()" title="Print">
<span class="fa fa-print"></span></button>

</div>
<?php

addToFavorite('favorite');
removeToFavorite('favorite');
?>
<?php require_once('Footer.php');?>

