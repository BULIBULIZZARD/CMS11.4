<?php
require '../init.inc.php';
Validate::checkSession();
global $_tpl;
//入口
$_rotatain=new RotatainAction($_tpl);
Validate::checkPremission(10,$_SESSION['admin']['premission'])?Tool::alertBack("您没有设置轮播器的权限"):true;
$_rotatain->_action();
$_tpl-> display('rotatain.tpl');
?>