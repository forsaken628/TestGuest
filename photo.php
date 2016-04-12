<?php
define('IN_TG', 'photo');
define('IN_JS', 'skin');
define('SCRIPT', 'photo');
include_once 'includes/common.inc.php';
require_once 'title.php';
require 'header.php';
if (!isset($_COOKIE['username'])) {
    _alert_close('请先登录！');
}
_uniqid();
if ($_GET['action'] == 'delete') {
    $_clean['id'] = intval($_GET['id']);
    $row = _fetch_array("SELECT tg_dir FROM tg_dir WHERE tg_id={$_clean['id']}");
    _remove_Dir($row['tg_dir']);
    _query("DELETE FROM tg_dir WHERE tg_id={$_clean['id']}");
}

?>
    <div id="photo">
        <h2>相册列表</h2>
        <?php
        $sql = "SELECT dir.tg_id,dir.tg_face,dir.tg_name,dir.tg_type,count(p.tg_id) tg_num FROM tg_dir dir LEFT JOIN tg_photo p ON p.tg_sid=dir.tg_id GROUP BY dir.tg_id";
        $result = _query($sql);
        while ($row = _fetch_array_list($result)) {
            echo '<dl>';
            ?>
            <dt><a href="photo_show.php?id=<?= $row['tg_id'] ?>"><img src="thumb.php?filename=<?= $row['tg_face'] ?>&wid=70" alt=""/></a></dt>
            <dd><a href="photo_show.php?id=<?= $row['tg_id'] ?>"><?= $row['tg_name'] ?> [<?= $row['tg_num'] ?>]
                    (<?= ($row['tg_type'] ? '私密' : '公开') ?>)</a></dd>
            <dd>[<a href="photo_modify_dir.php?id=<?= $row['tg_id'] ?>">修改</a>] [<a
                    href="photo.php?action=delete&id=<?= $row['tg_id'] ?>">删除</a>]
            </dd>
            <?php echo '</dl>';
        } ?>
        <p><a href="photo_add_dir.php">添加目录</a></p>
    </div>
<?php
require 'footer.php';