<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'flower');
define('IN_JS', 'message');
//定义个常量，用来指定本页的内容
define('SCRIPT', 'flower');
$_id='id='.$_GET['id'].'&';
//引入公共文件
require 'title.php';
require dirname(__FILE__) . '/includes/common.inc.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();
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
if($_GET['action']=='send'){
    $sql="INSERT INTO tg_flower SET tg_touser='{$_POST['touser']}', tg_fromuser='{$_COOKIE['username']}',
 tg_flower={$_POST['flower']}, tg_content='{$_POST['content']}', tg_date=NOW() ";
    if(_query($sql)){
        _alert_close('成功');
    }else{
        _alert_close('失败');
    }
}

?>
<body>
<script type="text/javascript" src="js/code.js"></script>
<div id="message">
    <h3>送花</h3>
    <form method="post" action="?<?=$_id?>action=send">
        <input type="hidden" name="touser" value="<?=$_html['touser']?>"/>
        <dl>
            <dd>
                <input type="text" readonly="readonly" value="TO:<?=$_html['touser']?>" class="text"/>
                <select name="flower">
                    <?php
                        for($i=1;$i<=100;$i++){
                            echo "<option value=\"$i\"> x{$i}朵</option>";
                        }
                    ?>
                </select>
            </dd>
            <dd><textarea name="content">灰常欣赏你，送你花啦~~~</textarea></dd>
            <dd>验 证 码：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"/>
                <input type="submit" class="submit" value="送花"/></dd>
        </dl>
    </form>
</div>
</body>
</html>