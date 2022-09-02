<?php require_once('header.php');?>
<div class="container">
<div class="row rounded p-2 m-2 text-center"> 
<div class="col-11 col-sm-8 col-md-6 col-lg-4 col-xl-4 section p-2 rounded shadow m-auto text-center">
<h4>Reset Password</h4> 
</div>
</div>

<div class="row">
<form action="resetpassword" method="POST"
class="col-11 col-sm-10 col-md-6 col-lg-4 col-xl-4 p-2 rounded shadow m-auto text-center">
<img src="../assets/img/resetpassword.svg" alt="" style="width:15rem;">


<div class="form-group text-start">
<label for="codelabel"> <span class="fa fa-code"></span>Code</label>
<input type="number" name="code"  class="form-control mb-3" id="codelabel" 
placeholder="Reset Code">
</div>

<div class="form-group text-start">
<label for="newpasswordlabel"> <span class="fa fa-lock"></span>New Password</label>
<input type="password" name="newpassword"  class="form-control mb-3" id="newpasswordlabel" 
placeholder="Enter New Password">
</div>

<button class="col-12 btn btn-warning btn-lg mb-2" name="reset"> 
<span class="fa fa-edit"></span> Change Password
</button>

<a href="login" class="btn btn-primary btn-sm">Back To Login</a>

</form>
</div>

</div>
<?php
if (isset($_POST['reset'])) {
    $code = request($_POST['code']);
    $newpassword =md5(request($_POST['newpassword']));
    if(empty($code)){
    message('Code is Required','warning');
    redirect('resetpassword');
}

if(empty($newpassword)){
    message('New Password is Required','warning');
    redirect('resetpassword');
}

else {
    $checkcode=countData("SELECT * FROM account_forget WHERE code='{$code}'");
    if ($checkcode > 0) {
        $getEmail=findData("SELECT * FROM account_forget WHERE code='{$code}'");
        $email=$getEmail['email'];
        execute ("UPDATE accounts SET account_password='{$newpassword}' WHERE account_email='{$email}'");
        execute ("DELETE FROM account_forget WHERE email='{$email}' ");
        message('Succesfully Changed Password','success');
        redirect('login');
    }

    else {
        message('The Code Is Inccorect','warning');
    redirect('resetpassword');
    }

}

}
    ?>
<?php require_once('footer.php');?>