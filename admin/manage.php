<?php
require '../init.inc.php';
Validate::checkSession();
Validate::checkPremission(4,$_SESSION['admin']['premission'])?Tool::alertBack("您没有操作管理员的权限"):true;
global $_tpl;
//入口
$_manage=new ManageAction($_tpl);
$_manage->_action();
$_tpl-> display('manage.tpl');





?>