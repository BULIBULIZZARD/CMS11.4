<?php
require __DIR__.'/init.inc.php';
global $_tpl;
$_register=new RegisterAction($_tpl);
$_register->_action();
$_tpl->display('register.tpl');
?>
