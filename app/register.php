<?php require_once('header.php');?>
<div class="container">
<div class="row rounded p-2 m-2 text-center"> 
<div class="col-11 col-sm-8 col-md-6 col-lg-4 col-xl-4 section p-2 rounded shadow m-auto text-center">
<h4>Create An Account</h4> 
</div>
</div>
<div class="row">
<form action="register.php" method="POST"
class="col-11 col-sm-10 col-md-6 col-lg-4 col-xl-4 p-2 rounded shadow m-auto text-center">
<img src="../assets/img/register.svg" alt="" style="width:15rem;">
<div class="form-group text-start">
<label for="usernamelabel"> <span class="fa fa-user"></span> Username</label>
<input type="text" name="account_name"  class="form-control mb-3" id="usernamelabel" 
placeholder="Username">
</div>

<div class="form-group text-start">
<label for="emaillabel"> <span class="fa fa-envelope"></span> Email</label>
<input type="email" name="account_email"  class="form-control mb-3" id="emaillabel" 
placeholder="Email">
</div>


<div class="form-group text-start">
<label for="passwordlabel"> <span class="fa fa-lock"></span> Password</label>
<input type="password" minlength="8" maxlength="16" name="account_password"  class="form-control mb-3" id="passwordlabel" 
placeholder="Password">
</div>


<div class="form-group text-start">
<label for="confirmpasswordlabel"> <span class="fa fa-key"></span> Confirm Password</label>
<input type="password" minlength="8" maxlength="16" name="account_confirmpassword"  class="form-control mb-3" id="confirmpasswordlabel" 
placeholder="ConfirmPassword">
</div>
<button name="createaccount" class="col-12 btn btn-success btn-lg mb-2"> 
<span class="fa fa-user-plus"></span> Create Account
</button>
<a href="login.php" class="btn btn-primary btn-sm">Already Have An Account</a>
</form>
</div>
</div>
<?php 

if (isset($_POST['createaccount'])) {
    $account_name = request($_POST['account_name']);
    $account_email = request($_POST['account_email']);
    $account_password = md5(request($_POST['account_password']));
    $account_confirmpassword = md5(request($_POST['account_confirmpassword']));

    if (empty($account_name)) {
        message ('Username is Required','warning');
        redirect('register');

    }
    if (empty($account_email)) {
        message ("Email is Required",'warning');
        redirect('register');

    }
    if (empty($account_password)) {
        message ('Account Password','warning');
        redirect('register');

    }

    if (empty($account_confirmpassword)) {
        message ('Account Confirm Password','warning');
        redirect('register');

    }

   



    $checkEmail = countData(" SELECT * FROM accounts WHERE account_email='$account_email' ");
    if($checkEmail > 0) {
        message('Email Already Added','danger');
        redirect('register');
    }
    if($account_password!=$account_confirmpassword) {
        message('Passwords Arent Same','danger');
        redirect('register');
    }
    else {
        $createAccount = execute(" INSERT INTO accounts(account_name,account_email,account_password) 
        VALUES('$account_name','$account_email','$account_password'); ");
        message('Account Created','success');
        redirect('login');
   }
}
   
?>
<?php require_once('footer.php');?>