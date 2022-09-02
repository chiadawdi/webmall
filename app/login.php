<?php require_once('header.php');?>
<div class="container">
<div class="row rounded p-2 m-2 text-center"> 
<div class="col-11 col-sm-8 col-md-6 col-lg-4 col-xl-4 section p-2 rounded shadow m-auto text-center">
<h4>Login To Your Account</h4> 
</div>
</div>

<div class="row">
<form action="login.php" method="POST"
class="col-11 col-sm-10 col-md-6 col-lg-4 col-xl-4 p-2 rounded shadow m-auto text-center">
<img src="../assets/img/login.svg" alt="" style="width:15rem;">

<div class="form-group text-start">
<label for="usernamelabel"> <span class="fa fa-user"></span> Username Or Email</label>
<input type="text" name="username"  class="form-control mb-3" id="usernamelabel" 
placeholder="Username Or Email">
</div>



<div class="form-group text-start">
<label for="passwordlabel"> <span class="fa fa-lock"></span> Password</label>
<input type="password" name="password"  class="form-control mb-3" id="passwordlabel" 
placeholder="Password">
</div>


<button class="col-12 btn btn-primary btn-lg mb-2" name="auth"> 
<span class="fa fa-sign-in"></span> Login
</button>

<a href="register" class="btn btn-success btn-sm">Not Have An Account</a>
<a href="forgetpassword" class="btn btn-danger btn-sm">Forget Password..??</a>

</form>
</div>

</div>
<?php
if (isset($_POST['auth'])) {
    $username = request($_POST['username']);
    $password = md5(request($_POST['password']));

    if (empty($username) && empty($password)) {
        message ('All Fields are Required','warning');
        redirect('login','warning');

    }
    $authQuery=" SELECT * FROM accounts
    WHERE (account_email='{$username}' OR account_name='{$username}') AND account_password='{$password}'  ";
    $checkAuth = countData($authQuery);
     if($checkAuth > 0) {
        $getAuthdata = findData($authQuery);
        $account_id=$getAuthdata['account_id'];
        $account_name=$getAuthdata['account_name'];
        $account_email=$getAuthdata['account_email'];
        $_SESSION['account_id']=$account_id;
        message('Welcome','success');
        redirect('index');


        

    }

    else {
        message('Wrong Information','danger');
        redirect('login');
    }
   
   
}

    ?>
<?php require_once('footer.php');?>