<?php
/**
 * TestGuest Version1.0
 * ================================================
 * Copy 2010-2012 yc60
 * Web: http://www.yc60.com
 * ================================================
 * Author: Lee
 * Date: 2010-9-8
 */
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'friend');
//定义个常量，用来指定本页的内容
define('IN_JS', 'message');
define('SCRIPT', 'friend');
//引入公共文件
require dirname(__FILE__) . '/includes/common.inc.php';

//判断是否登录了
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();
//添加好友
if ($_GET['action'] == 'add') {
    _check_code($_POST['code'], $_SESSION['code']);
    include 'includes/check.func.php';
    $_clean = array();
    $_clean['touser'] = $_POST['touser'];
    $_clean['fromuser'] = $_COOKIE['username'];
    $_clean['content'] = _check_content($_POST['content']);
    $_clean = _mysql_string($_clean);
    //不能添加自己
    if ($_clean['touser'] == $_clean['fromuser']) {
        _alert_close('请不要添加自己！');
    }
    //数据库验证好友是否已经添加
    if (!!$_rows = _fetch_array("SELECT tg_id FROM tg_friend WHERE
    tg_touser IN ('{$_clean['touser']}','{$_clean['fromuser']}') AND tg_fromuser IN ('{$_clean['fromuser']}','{$_clean['touser']}') LIMIT 1")
    ) {
        _alert_close('你们已经是好友了！或者是未验证的好友！无需添加！');
    } else {
        //添加好友信息
        _query("INSERT INTO tg_friend (tg_touser,tg_fromuser,tg_content,tg_date)
		VALUE ('{$_clean['touser']}','{$_clean['fromuser']}','{$_clean['content']}',NOW())");
        if (_affected_rows() == 1) {
            _close();
            //_session_destroy();
            _alert_close('好友添加成功！请等待验证！');
        } else {
            _close();
            //_session_destroy();
            _alert_back('好友添加失败！');
        }
    }
}
//获取数据
if (isset($_GET['id'])) {
    if (!!$_rows = _fetch_array("SELECT tg_username  FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 	1")) {
        $_html = array();
        $_html['touser'] = $_rows['tg_username'];
        $_html = _html($_html);
    } else {
        _alert_close('不存在此用户！');
    }
} else {
    _alert_close('非法操作！');
}
require 'title.php';
?>

<body>
<script type="text/javascript" src="js/code.js"></script>


<div id="message">
    <h3>添加好友</h3>
    <form method="post" action="?action=add">
        <input type="hidden" name="touser" value="<?= $_html['touser'] ?>"/>
        <dl>
            <dd><input type="text" readonly="readonly" value="TO:<?= $_html['touser'] ?>" class="text"/></dd>
            <dd><textarea name="content">我非常想和你交朋友！</textarea></dd>
            <dd>验 证 码：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"/>
                <input type="submit" class="submit" value="添加好友"/></dd>
        </dl>
    </form>
</div>
</body>
</html>