<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(5,$_SESSION['admin']['premission'])?Tool::alertBack("您没有设置等级的权限"):true;
$_level=new LevelAction($_tpl);
$_level->_action();
$_tpl-> display('level.tpl');





?>