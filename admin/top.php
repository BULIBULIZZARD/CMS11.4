<?php
require '../init.inc.php';
Validate::checkSession();
global $_tpl;
$_tpl->assgin('admin_user', $_SESSION['admin']['admin_user'] );
$_tpl->assgin('level_name', $_SESSION['admin']['level_name'] );
$_tpl->display('top.tpl');
?>