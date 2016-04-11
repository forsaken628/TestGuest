<?php
/**
 * Created by PhpStorm.
 * User: ad
 * Date: 2016/4/11
 * Time: 9:52
 */
define('IN_TG', 'logout');
include_once 'includes/common.inc.php';
_unsetcookies();
header('location:index.php');