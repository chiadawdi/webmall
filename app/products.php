<?php
require_once('header.php');
if (checkRole()!='admin') {
    redirect('index');
}

?>
<div class="container">
    
    <div class="row rounded p-2 m-2 text-center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  m-auto shadow-sm rounded p-1">
    <a href="products" class="float-start  text-light   bg-purple rounded p-1">Products</a>
    <a href="?add" class="btn btn-success btn-lg float-end">Add Product <span class="fa fa-plus"></span></a>
</div>
   <?php
if (isset($_GET['add'])) {
?>
 <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-8 m-auto text-center shadow-sm rounded mt-4">
<form action="products" method="POST" class="m-2">

<h4>Add Product</h4>

<div class="form-group text-start">
    <label class="">Product Name: <span class="fa fa-pen"></span></label>
<input type="text" class="form-control text-center p-2 rounded" required placeholder="product name" 
name="productname">
</div>

<div class="form-group text-start">
    <label class="">Product Price : <span class="fa-solid fa-dollar"></span></label>
<input type="number" min="0" class="form-control text-center p-2 rounded" required placeholder="product Price"
 name="productprice">
</div>

<div class="form-group text-start">
    <label class="">Product Quantity : <span class="fa fa-list-ol"></span> </label>
<input type="number" min="0" class="form-control text-center p-2 rounded" required placeholder="product Quantity"
 name="productquantity" value="0">
</div>

<button class="btn btn-success btn-lg m-1" name="addproduct">Add Product <span class="fa fa-plus"></span></button>

</form>
    </div>
</div>
<?php
}

elseif(isset($_GET['editproduct'])) {
    $productId= request($_GET['editproduct']);
    $checkproduct=countData(" SELECT * FROM products WHERE id='{$productId}' ");
    if ($checkproduct < 1) {
        redirect('products');  
    }
    else{
        $getproduct =findData(" SELECT * FROM products WHERE id='{$productId}' ");
?>

 <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-8 m-auto text-center shadow-sm rounded mt-4">
 <h4>Edit Product</h4>
<form action="products" method="POST" class="m-2">
<input type="hidden" readonly name="productid" value="<?=$getproduct['id'];?>" required>
<div class="form-group text-start">
    <label class="">Product Name: <span class="fa fa-pen"></span></label>
<input type="text" class="form-control text-center p-2 rounded" required placeholder="product name" 
name="productname" value="<?=$getproduct['productname'];?>">
</div>

<div class="form-group text-start">
    <label class="">Product Price : <span class="fa-solid fa-dollar"></span></label>
<input type="number" min="0" class="form-control text-center p-2 rounded" required placeholder="product Price"
 name="productprice" value="<?=$getproduct['productprice'];?>">
</div>

<div class="form-group text-start">
    <label class="">Product Quantity : <span class="fa fa-list-ol"></span> </label>
<input type="number" min="0" class="form-control text-center p-2 rounded" required placeholder="product Quantity"
 name="productquantity" value="<?=$getproduct['productquantity'];?>">
</div>

<button class="btn btn-warning btn-lg m-1" name="editproduct">Edit Product <span class="fa fa-pen"></span></button>

</form>
    </div>
</div>
<?php
    }

}
?>
<div class="table-responsive mt-4">
<table class="table table-bordered table-hover text-center "></div>
<thead>
    <tr>
    <th>#</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>
</thead>

<tbody>
    <?php
$allproducts=allData("SELECT * FROM products ORDER BY id DESC");
foreach($allproducts as $product){
?>
<tr>

<td><?=$product['id'];?></td>
<td><?=$product['productname'];?></td>
<td><?=$product['productprice'];?></td>
<td><?=$product['productquantity'];?></td>
<td>
    <a href="products?editproduct=<?=$product['id'];?>" class="btn btn-sm btn-warning">
    <span class="fa fa-pen"></span>Edit </a>
     <a href="products?deleteproduct=<?=$product['id'];?>" class="btn btn-sm btn-danger">
     <span class="fa fa-pen"></span>Delete </a>

</td>
</tr>
<?php
}
?>

</tbody>

</table>
</div>
</div>
<?php

if (isset($_POST['addproduct'])) {
    $productname= request($_POST['productname']);
    $productprice= request($_POST['productprice']);
    $productquantity= request($_POST['productquantity']);
    execute(" INSERT INTO products(productname,productprice,productquantity) VALUES 
    ('{$productname}','{$productprice}','{$productquantity}');");
    message ('Created..!','success');
        redirect('products');
   
}
if (isset($_POST['editproduct'])) {
    $productid= request($_POST['productid']);
    $productname= request($_POST['productname']);
    $productprice= request($_POST['productprice']);
    $productquantity= request($_POST['productquantity']);
    execute("UPDATE products SET productname='{$productname}', productprice='{$productprice}',
    productquantity='{$productquantity}' WHERE id='{$productid}'");
    message ('Updated..!','success');
        redirect('products');
   
}

if (isset($_GET['deleteproduct'])) {
    $productId= request($_GET['deleteproduct']);
    $checkproduct=countData(" SELECT * FROM products WHERE id='{$productId}' ");
    if ($checkproduct>0) {
        execute(" DELETE FROM products WHERE id='{$productId}'");
        message ('Deleted..!','danger'); 
    }
    
      redirect('products');
   
}

?>
<?php
require_once('Footer.php');?>