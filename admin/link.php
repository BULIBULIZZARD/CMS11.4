<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(13,$_SESSION['admin']['premission'])?Tool::alertBack("您没有管理友情链接的权限"):true;
$_link=new LinkAction($_tpl);
$_link->_action();
$_tpl-> display('link.tpl');





?>