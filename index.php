<?php
define('IN_TG', 'index');
define('IN_JS', 'blog');
define('SCRIPT', 'index');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';

_page("SELECT count(tg_id) FROM tg_article WHERE tg_reid=0", 10);//_page已优化
$sql = "SELECT
  d.tg_type,
  d.tg_readcount,
  d.tg_commendcount,
  d.tg_id,
  d.tg_title,
  MAX(IFNULL(GREATEST(b.tg_last_modify_date,b.tg_date),GREATEST(d.tg_last_modify_date,d.tg_date))) date
FROM tg_article d LEFT JOIN tg_article b ON b.tg_reid = d.tg_id
WHERE d.tg_reid = 0
GROUP BY d.tg_id
ORDER BY date DESC LIMIT {$_pagenum},10";
$result = _query($sql);
?>
    <div id="list">
        <h2>帖子列表</h2>
        <a href="post.php" class="post">发表帖子</a>
        <ul class="article">
            <?php
            while ($row = _fetch_array_list($result)) {
                $title = _title($row['tg_title'], 30);
                echo <<<a
<li class="icon{$row['tg_type']}"><em>阅读数(<strong>{$row['tg_readcount']}</strong>) 评论数(<strong>{$row['tg_commendcount']}</strong>)</em> <a href="article.php?id={$row['tg_id']}">{$title}</a>
        </li>
a;
            }
            ?>
        </ul>
        <div id="page_text">
            <ul>
                <?php _paging(2) ?>
            </ul>
        </div>
    </div>

    <div id="user">
        <h2>新进会员</h2>
        <dl>
            <?php
            $sql = 'SELECT tg_id,tg_username,tg_sex,tg_face,tg_email,tg_url FROM tg_user ORDER BY tg_reg_time DESC LIMIT 1';
            $row = _fetch_array($sql);
            echo <<<a
<dd class="user">{$row['tg_username']}({$row['tg_sex']})</dd>
        <dt><img alt="{$row['tg_username']}" src="{$row['tg_face']}"></dt>
        <dd class="message"><a title="{$row['tg_id']}" name="message" href="javascript:;">发消息</a></dd>
        <dd class="friend"><a title="{$row['tg_id']}" name="friend" href="javascript:;">加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a title="{$row['tg_id']}" name="flower" href="javascript:;">给他送花</a></dd>
        <dd class="email">邮件：<a href="mailto:{$row['tg_email']}">{$row['tg_email']}</a></dd>
        <dd class="url">网址：<a target="_blank" href="{$row['tg_url']}">{$row['tg_url']}</a></dd>
a;
            ?>
        </dl>
    </div>
    <div id="pics">
        <?php
        $img = _fetch_array("SELECT p.tg_id,p.tg_name,p.tg_content,p.tg_url
FROM tg_photo p JOIN tg_dir d ON p.tg_sid=d.tg_id WHERE d.tg_type=0 ORDER BY p.tg_date DESC LIMIT 1");
        ?>
        <h2>最新图片 -- <?=$img['tg_name']?></h2>
        <a href="photo_detail.php?id=<?=$img['tg_id']?>"><img alt="<?=$img['tg_content']?>" src="thumb.php?filename=<?= $img['tg_url']?>&wid=200"></a>
    </div>
<?php
require_once 'footer.php';