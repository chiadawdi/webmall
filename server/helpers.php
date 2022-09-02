<?php 
function redirect($page){
ob_start();
header('location:'.$page);
exit;
}

function execute($sql) {
global $conn;
return mysqli_query($conn,$sql);
}

function findData($sql) {
$result = execute($sql);
return mysqli_fetch_assoc($result);
}
function allData($sql) {
$result = execute($sql);
$alldata = [];
 while($row = mysqli_fetch_assoc($result)){
     $alldata[] = $row;
 }
 return $alldata;
}
function countData($sql) {
$result = execute($sql);
return $count = mysqli_num_rows($result );
}
function request($input){
    global $conn;
    return mysqli_real_escape_string($conn,trim($input)); 
}


function message($msg,$type) {
    if(isset($_SESSION['message']) && isset($_SESSION['type'])){
        unset($_SESSION['message']);
        unset($_SESSION['type']);
        $_SESSION['message'] = $msg;
        $_SESSION['type'] = $type;
    }
    else {
        $_SESSION['message'] = $msg;
        $_SESSION['type'] = $type;
    }
}



 function messagebox() {
if(isset($_SESSION['message']) && isset($_SESSION['type'])) {
$message =  $_SESSION['message'];
$type =  $_SESSION['type'];
if($message!=null && $type!=null) {
?>
<div class="alert alert-<?=$type;?> text-center font-weight-bold" role="alert">
<?=$message;?>
</div>
<?php
}
}
}

function isAuth (){

    if (isset($_SESSION['account_id'])) {
        
        return true;
      }
      else {
        return false;
      }

}
 function checkAuth(){
    if (isset($_SESSION['account_id'])) {
    $account_id=$_SESSION['account_id'];
    $checkAuthQuery= "SELECT * FROM accounts WHERE account_id='{$account_id}'";
    $countAuthdata=countData($checkAuthQuery);
    if ($countAuthdata >0) {
    return $account_id;
    }
    else {
        redirect('login');
    }
 }
else {
redirect('login');
}
}

function getAuth (){
    $account_id = checkauth();
  $checkAuthQuery= "SELECT * FROM accounts WHERE account_id='{$account_id}'";
  $getAuthdata=findData($checkAuthQuery);
return $getAuthdata;

}


function fetchAuth(){
    if (isset($_SESSION['account_id'])) {
    $account_id=$_SESSION['account_id'];
    $checkAuthQuery= "SELECT * FROM accounts WHERE account_id='{$account_id}'";
    $countAuthdata=countData($checkAuthQuery);
    if ($countAuthdata >0) {
       
        $checkAuthQuery= "SELECT * FROM accounts WHERE account_id='{$account_id}'";
        $getAuthdata=findData($checkAuthQuery);
      return $getAuthdata;
    }
    else {
        return null;
    }
   
 }
 else {
    return null;
 }
 
}

function checkRole (){
    $account_id = checkauth();
  $checkAuthQuery= "SELECT * FROM accounts WHERE account_id='{$account_id}'";
  $getAuthdata=findData($checkAuthQuery);
$role= $getAuthdata['role'];
if ($role==='admin') {
    return"admin";
}
else {
    return "user";
}
}




require_once ('mail//PHPMailer.php');
require_once ('mail//SMTP.php');

function mailer($to,$subject,$body){

    $mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                                           
    $mail->Host       = MAILER_HOST;                     
    $mail->SMTPAuth   = MAILER_AUTH;                                  
    $mail->Username   = MAILER_USERNAME;                     
    $mail->Password   = MAILER_PASSWORD;                               
    $mail->SMTPSecure = MAILER_SECURE;           
    $mail->Port       = MAILER_PORT;                                  
    $mail->setFrom(MAILER_USERNAME, MAILER_FULLNAME);
    $mail->addAddress($to);           
    $mail->addReplyTo(MAILER_USERNAME, MAILER_FULLNAME);
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->send();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



}