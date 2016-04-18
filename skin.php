<?php
/**
 * Created by PhpStorm.
 * User: ad
 * Date: 2016/4/11
 * Time: 18:48
 */
define('IN_TG', 'skin');
define('IN_JS', 'blog');
define('SCRIPT', 'skin');
setcookie('skin',$_GET['id']);
include_once 'includes/common.inc.php';
_location('','index.php');
