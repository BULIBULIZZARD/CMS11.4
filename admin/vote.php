<?php
require '../init.inc.php';

global $_tpl;

//入口
Validate::checkSession();
Validate::checkPremission(12,$_SESSION['admin']['premission'])?Tool::alertBack("您没有管理投票的权限"):true;
$_vote=new VoteAction($_tpl);
$_vote->_action();
$_tpl-> display('vote.tpl');





?>