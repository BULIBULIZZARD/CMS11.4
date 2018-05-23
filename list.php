<?php
require __DIR__.'/init.inc.php';
global $_tpl;
$_list=new ListAction($_tpl);
$_list->_action();
$_tpl->display('list.tpl');
?>
