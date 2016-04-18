<?php
/**
 * TestGuest Version1.0
 * ================================================
 * Copy 2010-2012 yc60
 * Web: http://www.yc60.com
 * ================================================
 * Author: Lee
 * Date: 2010-8-10
 */
//防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined!');
}

//设置字符集编码
header('Content-Type: text/html; charset=utf-8');

//转换硬路径常量
define('ROOT_PATH', substr(__DIR__, 0, -8));

//创建一个自动转义状态的常量
define('GPC', get_magic_quotes_gpc());

//拒绝PHP低版本
if (PHP_VERSION < '4.1.0') {
    exit('Version is to Low!');
}

//引入函数库
require ROOT_PATH . 'includes/global.func.php';
require ROOT_PATH . 'includes/mysql.func.php';

//执行耗时
define('START_TIME', _runtime());
//$GLOBALS['start_time'] = _runtime();
require_once 'mysql.php';

//初始化数据库
_connect();   //连接MYSQL数据库
_select_db();   //选择指定的数据库
_set_names();   //设置字符集

//短信提醒,COUNT(tg_id)是取得字段的总和
if (isset($_COOKIE['username'])) {
    $_message = _fetch_array("SELECT  COUNT(tg_id) AS count FROM	tg_message
WHERE tg_state=0 AND tg_touser='{$_COOKIE['username']}'
");
    if (empty($_message['count'])) {
        $GLOBALS['message'] = 0;
    } else {
        $GLOBALS['message'] = $_message['count'];
    }
}

//皮肤
if(isset($_COOKIE['skin']))
define('SKIN',intval($_COOKIE['skin']));
else{
    define('SKIN',3);
}
