<?php
require '../init.inc.php';

isset($_SESSION['admin'])?Tool::alertLocation(null,'admin.php'):Tool::alertLocation(null,'admin_login.php');


?>