<?php
define('IS_CACHE',false);
global $_tpl;
global $_noCache;
if (IS_CACHE&&!$_noCache) {
    ob_start();
    $_tpl->cache(Tool::tplName() . '.tpl');
}
$_nav = new NavAction($_tpl);
$_nav->showfront();
$_cookie = new Cookie('user');
if (IS_CACHE) {
    $_tpl->assgin('header', '<script type="text/javascript" >getHeader();</script>');
    
} else {
    if ($_cookie->getCookie()) {
        $_tpl->assgin('header', '<a class="user">'.$_cookie->getCookie() . '______</a><a href="register.php?action=logout" class="user">退出</a>');
    } else {
        $_tpl->assgin('header', '<a href="register.php?action=reg" class="user">注册</a>
<a href="register.php?action=login" class="user">登陆</a>');
    }
}

$_link=new FriendLinkAction($_tpl);
$_link->index();
$_search=new SearchAction($_tpl);
$_search->getTag();
$_tpl->assgin('webname', WEBNAME);
?>   