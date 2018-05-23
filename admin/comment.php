<?php
require '../init.inc.php';
Validate::checkSession();
Validate::checkPremission(9,$_SESSION['admin']['premission'])?Tool::alertBack("您没有审核评论的权限"):true;
global $_tpl;
//入口
$_comment=new CommentAction($_tpl);
$_comment->_action();
$_tpl-> display('comment.tpl');





?>