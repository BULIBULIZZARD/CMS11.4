<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(14,$_SESSION['admin']['premission'])?Tool::alertBack("您没有管理会员的权限"):true;
$_user=new UserAction($_tpl);
$_user->_action();
$_tpl-> display('user.tpl');





?>