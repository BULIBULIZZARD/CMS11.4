<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(11,$_SESSION['admin']['premission'])?Tool::alertBack("您没有管理广告服务的权限"):true;
$_adver=new AdverAction($_tpl);
$_adver->_action();
$_tpl-> display('adver.tpl');





?>