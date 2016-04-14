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
define('IN_TG', 'message');
//定义个常量，用来指定本页的内容
define('IN_JS', 'message');
define('SCRIPT', 'message');
//引入公共文件
require dirname(__FILE__) . '/includes/common.inc.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();

if($_GET['action']=='send'){
    $sql="INSERT INTO tg_message SET tg_touser='{$_POST['touser']}', tg_fromuser='{$_COOKIE['username']}',
 tg_content='{$_POST['content']}', tg_date=NOW() ";
    if(_query($sql)){
        _alert_close('成功');
    }else{
        _alert_close('失败');
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
    <h3>发送信息</h3>
    <form method="post" action="?action=send">
        <input type="hidden" name="touser" value="<?= $_html['touser'] ?>"/>
        <dl>
            <dd><input type="text" readonly="readonly" value="TO:<?= $_html['touser'] ?>" class="text"/></dd>
            <dd><textarea name="content">我非常想和你交朋友！</textarea></dd>
            <dd>验 证 码：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"/>
                <input type="submit" class="submit" value="发送"/>
            </dd>
        </dl>
    </form>
</div>
</body>
</html>