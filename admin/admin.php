<?php
require '../init.inc.php';
Validate::checkSession();
global $_tpl;
$_tpl->display('admin.tpl');
?>