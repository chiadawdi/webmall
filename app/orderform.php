<?php
require_once('header.php');

if (checkRole()=='admin') {
    redirect('index');
}



$productId=request($_GET['productid']);
$sql="SELECT * FROM products WHERE id='{$productId}'";
$getproduct=findData("$sql");
$checkproduct=countData("$sql");
if ($checkproduct === 0) {
    redirect('index');
}


?>
<div class="container-fluid">

<div class="row bg-white text-dark rounded p-2 m-2 text-center mt-2">

<button class="btn btn-info text-light p-1 m-1"  style="width:40px;"
 onclick="window.history.back()" title="Print">
<span class="fa fa-arrow-left"></span></button>


    <div class="col-12 col-sm-11 col-md-8 col-lg-8 m-auto text-center">
    <h3>Order Form</h3>
</div>
<hr>
<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-sl-6 m-auto text-center mt-2 ">
    <form action="orderform?productid=<?=$productId;?>" method="POST" class="shadow-sm p-2 rounded">

    <div class="form-group text-start">
<label for="ordernumberlable">Order Number</label>
<input type="text" min="1"  name="number"  class="form-control mb-3" id="ordernumberlabel"  readonly
value="<?=uniqid();?>" required>
</div>


<div class="form-group text-start">
<label for="pricelable">Price</label>
<input type="text" min="1"  name="price" step="any"  class="form-control mb-3" id="pricelabel"  readonly
value="<?=$getproduct['productprice'];?>" required>
</div>



<div class="form-group text-start">
<label for="quantitylable">Quantity </label>
<input type="number" min="1" value="0" name="qty"  class="form-control mb-3" id="quantitylabel" 
placeholder="Quantity" required>
</div>

<button class=" btn btn-success btn-lg mb-2" name="addorder"> 
<span class="fa fa-shopping-cart"></span> Order
</form>
</button>
</div>

<div class="col-11 col-sm-11 col-md-6 col-lg-6 col-xl-4 m-auto text-center mt-2  p-2 rounded">
<img src="../assets/img/shop.png" alt="" class="cart-img" style="width:100%;height: 100px;object-fit:contain">
<h4>Price:$ <?=$getproduct['productprice'];?></h4>
<h4>Quantity:<?=$getproduct['productquantity'];?> PCS</h4>
<p>Detail : </p>
<p>.......</p>
</div>

</div>
</div>

<?php

if (isset($_POST['addorder'])) {
$number=request($_POST['number']);
$price=request($_POST['price']);
$qty=request($_POST['qty']);
$amount=$qty*$price;
$date=date('Y-m-d');

if ($amount > $authwallet) {
    message (' You do not have the amount of money you need ,
     Please Recharge Your Wallet ......!','warning');             
    redirect('orderform?productid='.$productId);
}

else {

    if ($qty > $getproduct['productquantity']) {
        message ('Enough Quantity Is Not Exist From Store......!','warning'); 
    }

    else {
        execute(" INSERT INTO orders(number,productid,accountid,price,qty,amount,date) 
        VALUES ('{$number}','{$productId}','{$authId}','{$price}','{$qty}','{$amount}','{$date}')");
        
        execute("UPDATE accounts SET wallet=wallet-'$amount' WHERE account_id='$authId'");
        execute("UPDATE products SET productquantity=productquantity-'$qty' WHERE id='$productId' ");
        message ('Ordered....!','success');             
        
        }
    }

redirect('orderform?productid='.$productId);
}

?>

<?php  
require_once('Footer.php');?>