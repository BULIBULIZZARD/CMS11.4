<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(7,$_SESSION['admin']['premission'])?Tool::alertBack("您没有管理导航的权限"):true;
$_nav=new NavAction($_tpl);
$_nav->_action();
$_tpl->display('nav.tpl');





?>