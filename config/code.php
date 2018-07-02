<?php
require '../init.inc.php';
$_vc=new ValidateCode();
$_vc->doimg();
$_SESSION['code']=$_vc->getCode();
?>
