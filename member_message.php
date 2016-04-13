<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG', 'member');
define('IN_JS', 'member_message');
//定义个常量，用来指定本页的内容
define('SCRIPT', 'member');
$_id = 'id=' . $_GET['id'] . '&';
//引入公共文件
require dirname(__FILE__) . '/includes/common.inc.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();

require 'title.php';
require 'header.php';
?>
    <script type="text/javascript" src="js/skin.js"></script>
    <div id="member">
        <?php require 'includes/member.inc.php' ?>
        <div id="member_main">
            <h2>好友设置中心</h2>
        </div>
    </div>
<?php
require 'footer.php';