<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(15,$_SESSION['admin']['premission'])?Tool::alertBack("您没有更改系统配置的权限"):true;
$_system=new SystemAction($_tpl);
$_system->_action();
$_tpl-> display('system.tpl');





?>