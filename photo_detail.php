<?php
define('IN_TG', 'photo_detail');
define('IN_JS', 'article');
define('SCRIPT', 'index');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';

$row = _fetch_array("SELECT * FROM tg_photo WHERE tg_id={$_GET['id']}");
var_dump($row);
//$row = _fetch_array("(SELECT tg_id FROM tg_photo WHERE tg_id>{$_GET['id']} ORDER BY tg_id LIMIT 1)
//UNION ALL
// (SELECT tg_id FROM tg_photo WHERE tg_id<{$_GET['id']} ORDER BY tg_id DESC LIMIT 1)");
?>
    <script type="text/javascript" src="js/code.js"></script>
    <div id="photo">
        <h2>图片详情</h2>
        <a name="pre"></a><a name="next"></a>
        <dl class="detail">
            <dd class="name"><?= $row['tg_name'] ?></dd>
            <dt><a href="photo_detail.php?id=19#pre">上一页</a>
                <img src="<?= $row['tg_url'] ?>"/>
                <a href="photo_detail.php?id=15#next">下一页</a></dt>
            <dd>[<a href="photo_show.php?id=<?= $row['tg_sid'] ?>">返回列表</a>]</dd>
            <dd>浏览量(<strong><?= $row['tg_readcount'] ?></strong>) 评论量(<strong><?= $row['tg_commendcount'] ?></strong>)
                发表于：<?= $row['tg_date'] ?> 上传者：<?= $row['tg_username'] ?></dd>
            <dd>简介：<?= $row['tg_content'] ?></dd>
        </dl>

        <div id="page_num">
            <ul>
                <li><a href="photo_detail.php?id=16&page=1" class="selected">1</a></li>
            </ul>
        </div>

        <p class="line"></p>
        <form method="post" action="?action=rephoto">
            <input type="hidden" name="sid" value="16"/>
            <dl class="rephoto">
                <dd>标　　题：<input type="text" name="title" class="text" value="RE:ChinaJoyMM9"/> (*必填，2-40位)</dd>
                <dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　
                    <a href="javascript:;">Q图系列[2]</a>　
                    <a href="javascript:;">Q图系列[3]</a>
                </dd>
                <dd>
                    <?php require 'includes/ubb.inc.php' ?>
                    <textarea name="content" rows="9"></textarea>
                </dd>
                <dd>
                    验 证 码：
                    <input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"/>
                    <input type="submit" class="submit" value="发表帖子"/></dd>
            </dl>
        </form>
    </div>
<?php require 'footer.php';