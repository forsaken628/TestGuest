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
        <?php require 'includes/member.inc.php';
        $sql = "SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url,tg_autograph,tg_switch,tg_qq FROM tg_user WHERE tg_username='{$_COOKIE['username']}'";
        $row = _fetch_array($sql); ?>
        <div id="member_main">
            <h2>个人信息</h2>
            <dl>
                <dd>用 户 名：<?= $row['tg_username'] ?></dd>
                <dd>性　　别：<?= $row['tg_sex']?></dd>
                <dd>头　　像：<img alt="<?=$row['tg_username']?>" src="<?=$row['tg_face']?>">
                <dd>电子邮件：<?= $row['tg_email'] ?></dd>
                <dd>主　　页：<?= $row['tg_url'] ?></dd>
                <dd>Q 　 　Q：<?= $row['tg_qq'] ?></dd>
                <dd>个性签名：<?= ($row['tg_switch'] ? '启用' : '禁用') ?>
                    <?=($row['tg_switch'] ? '<p>'._ubb($row['tg_autograph']).'</p>': '') ?>
                </dd>
            </dl>
        </div>
    </div>
<?php
require 'footer.php';