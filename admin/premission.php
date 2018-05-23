<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(6,$_SESSION['admin']['premission'])?Tool::alertBack("您没有设置权限的权限(笑)"):true;
$_premission=new PremissionAction($_tpl);
$_premission->_action();
$_tpl-> display('premission.tpl');





?>