<?php
require '../init.inc.php';
global $_tpl;
$_login=new LoginAction($_tpl);
$_login->_action();
$_tpl->display('admin_login.tpl');
?>