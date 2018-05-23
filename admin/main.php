<?php
require '../init.inc.php';
Validate::checkSession();
global $_tpl;
$_main=new MainAction($_tpl);
$_main->_action();
$_tpl->display('main.tpl');
?>