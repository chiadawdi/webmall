<?php
require_once('../server/app.php');
if (isAuth()) {
    unset($_SESSION['account_id']);
    message('You Have Loged Out..!','warning');
    redirect('login');
}

else {
    redirect('index');
}

?>