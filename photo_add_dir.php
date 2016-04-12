<?php
define('IN_TG', 'photo_add_dir');
define('IN_JS', 'photo_add_dir');
define('SCRIPT', 'photo_add_dir');
include_once 'includes/common.inc.php';
include_once 'includes/check.func.php';
require_once 'title.php';
require 'header.php';
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();
if ($_GET['action'] == 'adddir') {
    $_clean['name'] = $_POST['name'];
    $_clean['content'] = $_POST['content'];
    $_clean = _html($_clean);
    $_clean = _mysql_string($_clean);
    $_clean['type'] = intval($_POST['type']);
    if ($_clean['type']) {
        $_clean['password'] = ',tg_password=\''._check_password($_POST['password'], $_POST['password'], 6).'\'';
    } else {
        $_clean['password'] = '';
    }
    $_clean['dir'] = 'photo/' . time();
    mkdir($_clean['dir']);
    _query("INSERT INTO tg_dir SET tg_name='{$_clean['name']}', tg_type={$_clean['type']} {$_clean['password']},
 tg_content='{$_clean['content']}',tg_dir='{$_clean['dir']}', tg_date=NOW() ");
    header('location:photo.php');
}
?>
<script type="text/javascript" src="js/skin.js"></script>
<div id="photo">
    <h2>添加相册目录</h2>
    <form method="post" action="?action=adddir">
        <dl>
            <dd>相册名称：<input type="text" name="name" class="text"/></dd>
            <dd>相册类型：<input type="radio" name="type" value="0" checked="checked"/> 公开
                <input type="radio" name="type" value="1"/> 私密
            </dd>
            <dd id="pass">相册密码：<input type="password" name="password" class="text"/></dd>
            <dd>相册描述：<textarea name="content"></textarea></dd>
            <dd><input type="submit" class="submit" value="添加目录"/></dd>
        </dl>
    </form>
</div>

<div id="footer">
    <p>本程序执行耗时为: 0.013秒</p>
    <p>版权所有 翻版必究</p>
    <p>本程序由<span>瓢城Web俱乐部</span>提供 源代码可以任意修改或发布 (c) yc60.com</p>
</div></body>
</html>
