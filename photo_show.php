<?php
define('IN_TG', 'photo_show');
define('IN_JS', 'skin');
define('SCRIPT', 'photo_show');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';

session_start();
$_clean['id'] = intval($_GET['id']);
_page("SELECT COUNT(tg_id) FROM tg_photo WHERE tg_sid={$_clean['id']}", 8);
$row = _fetch_array("SELECT tg_name,tg_type,tg_password FROM tg_dir WHERE tg_id={$_clean['id']}");
$tg_name = $row['tg_name'];
$tg_type = $row['tg_type'];
$tg_password = $row['tg_password'];
?>
    <div id="photo">
        <h2><?= $tg_name ?></h2>
        <?php
        if ($tg_type && $tg_password != sha1($_POST['password']) && !isset($_SESSION['photo_pwd'][$_clean['id']])) { ?>
            <form method="post" action="photo_show.php?id=<?php echo $_clean['id'] . '&page=' . $_page ?>">
                <p>请输入密码：<input type="password" name="password"/>
                    <input type="submit" value="确认"/></p>
            </form>
        <?php } else {
            $_SESSION['photo_pwd'][$_clean['id']] = true;
            $result = _query("SELECT * FROM tg_photo WHERE tg_sid={$_clean['id']} LIMIT $_pagenum,$_pagesize");
            while ($row = _fetch_array_list($result)) {
                ?>
                <dl>
                    <dt>
                        <a href="photo_detail.php?id=<?= $row['tg_id'] ?>">
                            <img src="thumb.php?filename=<?= $row['tg_url'] ?>&wid=200"/></a>
                    </dt>
                    <dd><a href="photo_detail.php?id=<?= $row['tg_id'] ?>"><?= $row['tg_name'] ?></a></dd>
                    <dd>阅(<strong><?= $row['tg_readcount'] ?></strong>)
                        评(<strong><?= $row['tg_commendcount'] ?></strong>)
                        上传者：<?= $row['tg_username'] ?></dd>
                    <dd>[<a href="photo_show.php?action=delete&id=34">删除</a>]</dd>
                </dl>
            <?php } ?>
            <div id="page_num">
                <?php $_id = "id={$_GET['id']}&";
                _paging(1) ?>
            </div>
            <p><a href="photo_add_img.php?id=4">上传图片</a></p>
        <?php } ?>
    </div>
<?php
require 'footer.php';