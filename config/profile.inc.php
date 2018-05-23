<?php
	define('WEBNAME', 'CMS内容管理系统');
	define('PAGE_SIZE', 5);
	define('ARTICLE_SIZE', 5);
	define('NAV_SIZE', 10);
	define('UPDIR', '/uploads/');
	define('RO_NUM', 5);
	define('ADVER_TEXT_NUM', 5);
	define('ADVER_PIC_NUM', 3);
	//不可变参数
	define('DB_HOST', 'localhost'); //主机ip
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'cms');
	define('GPC',get_magic_quotes_gpc());
	define('PREV_URL', $_SERVER["HTTP_REFERER"]);
	define('MARK',ROOT_PATH.'/images/sy.png');//水印
	define('TPL_DIR', ROOT_PATH.'/templates/');//模板文件目录
	define('TPL_C_DIR', ROOT_PATH.'/templates_c/');//编译文件目录
	define('CACHE', ROOT_PATH.'/cache/');//缓存文件目录
?>