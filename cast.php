<?php
require __DIR__.'/init.inc.php';
global $_tpl;
$_cast=new CastAction($_tpl);
$_cast->_action();
$_tpl->display('cast.tpl');
?>
