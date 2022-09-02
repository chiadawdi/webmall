<?php require_once('header.php');?>
<div class="container">
<div class="row rounded p-2 m-2 text-center"> 
<div class="col-11 col-sm-8 col-md-6 col-lg-4 col-xl-4 section p-2 rounded shadow m-auto text-center">
<h4>Forget Password</h4> 
</div>
</div>

<div class="row">
<form action="forgetpassword" method="POST"
class="col-11 col-sm-10 col-md-6 col-lg-4 col-xl-4 p-2 rounded shadow m-auto text-center">
<img src="../assets/img/forgetpassword.svg" alt="" style="width:15rem;">


<div class="form-group text-start">
<label for="emaillabel"> <span class="fa fa-user"></span> Email</label>
<input type="email" name="email"  class="form-control mb-3" id="emaillabel" 
placeholder="Email">
</div>

<button class="col-12 btn btn-success btn-lg mb-2" name="forget"> 
<span class="fa fa-plane"></span> Send Email
</button>

<a href="login" class="btn btn-primary btn-sm">Back To Login</a>

</form>
</div>

</div>
<?php
if (isset($_POST['forget'])) {
    $email = request($_POST['email']);
    if(empty($email)){
    message('Email is Required','warning');
    redirect('forgetpassword');
}
else {
    $checkemail=countData("SELECT * FROM accounts WHERE account_email='{$email}'");
    if ($chekemail > 0) {
        $code=rand(1000 , 1000000);
    mailer($email,'forget password',"
    Forget Code Is {$code}
    ");
    execute ("DELETE FROM account_forget WHERE email='{$email}' ");
    execute("INSERT INTO account_forget(email,code) VALUES('{$email}','{$code}') ");
    redirect('resetpassword');

    }

    else {

        message('Email is Not Exist ...','warning');
    redirect('forgetpassword');
        
    }
    
}

}
    ?>
<?php require_once('footer.php');?>