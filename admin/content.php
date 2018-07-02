<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(8,$_SESSION['admin']['premission'])?Tool::alertBack("您没有管理文章的权限"):true;
$_content=new ContentAction($_tpl);
$_content->_action();
$_tpl-> display('content.tpl');





?>